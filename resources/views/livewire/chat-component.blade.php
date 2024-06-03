<?php

use Livewire\Volt\Component;
use App\Events\MessengerEvent;
use Livewire\Attributes\On;

new class extends Component {
    public string $message ='';
    public array  $messages = [];

    public function sendMessage()
    {
        MessengerEvent::dispatch(Auth::user()->name, $this->message);
        $this->reset('message');
    }

    #[On('echo-private:messages,MessengerEvent')]
    public function onMessengerEvent($event)
    {
        $this->messages[] = $event;
    }

};
?>

<div>
    <x-chat-dialog :messages="$this->messages" toMethod="sendMessage" color="blue" name="Chat" />
</div>
