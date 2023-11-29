<?php

namespace App\Telegram;

use App\Models\User;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Log;
use Stringable;

class Handler  extends WebhookHandler {

        public function help():void {
           Telegraph::message("Выбери действие")
           ->keyboard(
            Keyboard::make()->buttons([
                Button::make("Перейти на канал")->url("https://t.me/gotham_kinomania")
            ])
            )->send();
        }


        protected function handleChatMemberJoined(\DefStudio\Telegraph\DTO\User $member): void{
            $this->chat->reply("Привет, {$member->firstName()}")->send();
        }
        protected function handleUnknownCommand(\Illuminate\Support\Stringable $text): void{
            $this->reply("Я пока не знаю такой команды $text");

        }
        protected function handleChatMessage(\Illuminate\Support\Stringable $text):void{
            Log::info(json_encode($this->message->toArray(), JSON_UNESCAPED_UNICODE));
            if ($text == "Привет") {
                $this->reply("Привет!");
            }
            if ($text == "Кто ты?" || $text == "кто ты?") {
                $this->reply("Я телеграм-бот канала Киномания");
            }
        }
        public function info(){
            
        }


}
