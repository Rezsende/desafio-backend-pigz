<?php

namespace App\Controller;
use App\Entity\Item;
use App\Entity\Lista;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class ItemController extends AbstractController
{
    #[Route('/api/listas/{id}/itens', name: 'add_item_to_lista', methods: ['POST'])]
    public function addItemToLista(
        int $id,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
      
        $lista = $em->getRepository(Lista::class)->find($id);

        if (!$lista) {
            return new JsonResponse(['erro' => 'Lista não encontrada.'], 404);
        }

        
        $data = json_decode($request->getContent(), true);

       
        if (!isset($data['descricao'])) {
            return new JsonResponse(['erro' => 'Descrição é obrigatória.'], 400);
        }

      
        $item = new Item();
        $item->setDescricao($data['descricao']);
        $item->setConcluida($data['concluida'] ?? false); // padrão: false
        $item->setLista($lista);

      
        $em->persist($item);
        $em->flush();

        return new JsonResponse([
            'mensagem' => 'Item adicionado com sucesso!',
            'item' => [
                'id' => $item->getId(),
                'descricao' => $item->getDescricao(),
                'concluida' => $item->isConcluida(),
                'lista_id' => $lista->getId()
            ]
        ], 201);
    }

    #[Route('/api/items/{id}', name: 'delete_item', methods: ['DELETE'])]
    public function deleteItem(int $id, EntityManagerInterface $em): JsonResponse
    {
      
        $item = $em->getRepository(Item::class)->find($id);

       
        if (!$item) {
            return new JsonResponse(['erro' => 'Item não encontrado.'], 404);
        }

        
        $em->remove($item);
        $em->flush();

       
        return new JsonResponse(['mensagem' => 'Item excluído com sucesso.'], 200);
    }

    #[Route('/api/items/{id}/concluida', name: 'update_item_concluida', methods: ['PATCH'])]
    public function updateConcluida(int $id, EntityManagerInterface $em): JsonResponse
    {
        
        $item = $em->getRepository(Item::class)->find($id);

       
        if (!$item) {
            return new JsonResponse(['erro' => 'Item não encontrado.'], 404);
        }

      
        $item->setConcluida(true);

        
        $em->flush();

       
        return new JsonResponse(['mensagem' => 'Item concluído com sucesso.'], 200);
    }
}
