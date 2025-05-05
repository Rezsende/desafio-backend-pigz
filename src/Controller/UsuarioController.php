<?php

namespace App\Controller;

use App\Entity\Lista;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    #[Route('/api/usuarios/{id}/listas', name: 'criar_lista', methods: ['POST'])]
    public function criarLista(
        int $id,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
       
        $usuario = $em->getRepository(Usuario::class)->find($id);

        if (!$usuario) {
            return new JsonResponse(['error' => 'Usuário não encontrado.'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!isset($data['nome'])) {
            return new JsonResponse(['error' => 'Campo "nome" é obrigatório.'], 400);
        }

        
        $lista = new Lista();
        $lista->setNome($data['nome']);
        $lista->setUsuario($usuario);

       
        $em->persist($lista);
        $em->flush();

        return new JsonResponse([
            'message' => 'Lista criada com sucesso!',
            'listaId' => $lista->getId(),
        ], 201);
    }

    #[Route('/api/listas/{id}', name: 'delete_lista', methods: ['DELETE'])]
    public function deleteLista(
        int $id,
        EntityManagerInterface $em
    ): JsonResponse {
      
        $lista = $em->getRepository(Lista::class)->find($id);

       
        if (!$lista) {
            return new JsonResponse(['erro' => 'Lista não encontrada.'], 404);
        }

      
        $em->remove($lista);
        $em->flush();

        
        return new JsonResponse(['mensagem' => 'Lista excluída com sucesso.'], 200);
    }
}
