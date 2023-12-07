<?php

namespace App\Controller\Sites;

use App\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class SitesGetByIdController extends AbstractController
{
    /**
     * @OA\Response(
     *      response=200,
     *      description="Retourne un site",
     *      @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref=@Model(type=Site::class))
     *      )
     *  )
     *
     * @OA\Tag(name="Site")
     *
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/sites/{id}', name: 'app_sites_get_by_id', methods: ['GET'])]
    public function __invoke(Site $site): JsonResponse
    {
        return $this->json($site);
    }
}
