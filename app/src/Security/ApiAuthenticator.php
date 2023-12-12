<?php

namespace App\Security;

use App\Entity\User;
use App\Service\InseeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class ApiAuthenticator extends AbstractAuthenticator
{
    private InseeService $inseeService;
    private EntityManagerInterface $entityManager;
    public function __construct(
        InseeService $inseeService,
        EntityManagerInterface $entityManager
    ) {
        $this->inseeService = $inseeService;
        $this->entityManager = $entityManager;
    }

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        if (null === $apiToken) {
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

//        try {
//            $this->inseeService->getCompanyBySiren($apiToken);
//        } catch (\Exception $exception) {
//            throw new CustomUserMessageAuthenticationException('Token invalid');
//        }

        if ($request->headers->get('X-AUTH-USERNAME')) {
            $apiUsername = $request->headers->get('X-AUTH-USERNAME');

            return new SelfValidatingPassport(new UserBadge($apiUsername, function (string $userIdentifier): ?User {
                $user = new User();
                $user->setEmail($userIdentifier);
                $user->setRoles(['ROLE_ADMIN']);
                $user->setType('symfony');
                return $user;
            }));
        }

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find(1);

        return new SelfValidatingPassport(new UserBadge($user->getUserIdentifier()));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}