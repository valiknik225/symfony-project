<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\CreateNoteCommand;
use App\Application\Command\DeleteNoteCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

#[Route(path: '/note', name: 'note')]
class NoteController extends AbstractController
{
    public function __construct(
        private MessageBusInterface $bus
    )
    {
        //
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route(path: '', name: 'create', methods: ['POST'])]
    public function createNote(Request $request): Response
    {
        $data = $request->toArray();

        if (isset($data['name']) && isset($data['content'])) {
            $command = new CreateNoteCommand($data['name'], $data['content']);
            $this->bus->dispatch($command);
            return new JsonResponse('Note creation message sent!');
        }
        return new JsonResponse('Invalid input data', Response::HTTP_BAD_REQUEST);
    }
//    #[Route(path: '/', name: 'create', methods: ['POST'])]
//    public function createNote(
//        #[MapRequestPayload(
//            acceptFormat: 'json', validationFailedStatusCode: Response::HTTP_NOT_FOUND,
//        )] CreateNoteCommand $command
//    ): Response

    /**
     * @throws ExceptionInterface
     */
    #[Route(path: '/{note}', name: 'delete', methods: ['DELETE'])]
    public function deleteNote(Uuid $noteId): Response
    {
        $command = new DeleteNoteCommand($noteId);
        $this->bus->dispatch($command);
        return new Response('Note deletion message sent!');
    }
}