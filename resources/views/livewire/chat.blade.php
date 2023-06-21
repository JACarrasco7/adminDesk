<div>
    <div class="grid sm:grid-cols-1 lg:grid-cols-6 h-[50rem] bg-white dark:bg-gray-800">
        <div class="col-span-2">
        <!-- chat list -->
        <div id="chat-list" class="flex flex-col h-[50rem] overflow-y-auto lg:border-r-2 border-slate-700">
            <!-- search compt -->
            <div class="px-2 py-4">
                <input type="text" placeholder="{{ __('Search chatting') }}"
                    class="w-full px-2 py-2 rounded-lg bg-slate-100 dark:bg-slate-600 dark:text-slate-100" />
            </div>
            <!-- end search compt -->
            <!-- user list -->

            @foreach ($users as $user)
            <span wire:click="getReceiveId({{ $user->id }})">
                <div
                    class="flex flex-row items-center justify-center px-2 py-4 conversationUser rounded-l-md hover:bg-slate-700 hover:cursor-pointer">
                    <div class="w-1/4">
                        <img src="https://source.unsplash.com/_7LbC5J-jw4/600x600"
                            class="object-cover w-12 h-12 rounded-full" alt="" />
                    </div>
                    <div class="w-full">
                        <div class="flex justify-between text-lg font-semibold">
                            {{ $user->username }}
                            @if (Helpers::getIsConnected($user->id))
                                <small class="ms-5 text-lime-500">Online</small>
                            @else
                                <small class="text-red-600 ms-5">Disconnected</small>
                            @endif
                        </div>
                        <span class="text-gray-500">
                            {{ $this->getLastMessageUser($user->id) }}
                        </span>
                    </div>
                </div>
            </span>
            @endforeach
            <!-- end user list -->
        </div>
        <!-- end chat list -->
        </div>
        <div class="col-span-4">
        <!-- chat -->
        <div id="chat" class="flex flex-col h-[50rem] sm:hidden lg:flex justify-between w-full px-5">
            @empty($receiver_id)
                <div class="flex justify-center h-screen">
                    <div class="m-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 m-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3" />
                        </svg>
                        <p class="m-auto mx-64 text-center">
                            Conecta con las personas adecuadas con tan solo un click para aumentar tu productividad.
                        </p>
                        <p class="m-auto mx-64 mt-8 text-center">
                            <b>AdminDesk</b>
                        </p>
                    </div>
                </div>
            @else
                <div wire:poll.750ms="getConversationWithUser()" id="divu"
                    class="flex flex-col overflow-auto scroll-smooth scrollbar-none">
                    <div class="py-2 border-b-2">
                        <svg id="arrow-back" wire:click="backToListChat()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                          </svg>
                    </div>
                    <div class="mt-4">
                    @foreach ($conversationMessages as $conversationMessage)
                        <div
                            class="flex justify-{{ $conversationMessage->transmitter_id == Auth::user()->id ? 'end' : 'star' }} mb-4">
                            <div class="px-4 py-3 mr-2 {{ $conversationMessage->transmitter_id == Auth::user()->id ? 'text-white bg-blue-400' : 'text-black bg-white' }}  rounded-bl-3xl rounded-tl-3xl rounded-tr-xl">
                                {{ $conversationMessage->message }}
                            </div>
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover w-8 h-8 rounded-full" alt="" />
                        </div>
                    @endforeach
                    </div>
                    {{-- <div class="flex justify-start mb-4">
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover w-8 h-8 rounded-full" alt="" />
                            <div class="px-4 py-3 ml-2 text-white bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat at praesentium, aut ullam
                                delectus odio error sit rem. Architecto nulla doloribus laborum illo rem enim dolor odio
                                saepe,consequatur quas?
                            </div>
                        </div>
                        <div class="flex justify-end mb-4">
                            <div>
                                <div
                                    class="px-4 py-3 mr-2 text-white bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Magnam, repudiandae.
                                </div>

                                <div
                                    class="px-4 py-3 mt-4 mr-2 text-white bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Debitis, reiciendis!
                                </div>
                            </div>
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover w-8 h-8 rounded-full" alt="" />
                        </div>
                        <div class="flex justify-start mb-4">
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover w-8 h-8 rounded-full" alt="" />
                            <div class="px-4 py-3 ml-2 text-white bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl">
                                happy holiday guys!
                            </div>
                        </div> --}}

                </div>
            @endempty

            @empty(!$receiver_id)
                <div class="grid grid-cols-12 py-5">
                    <div class="col-span-11">
                        <textarea wire:model="message" class="w-full px-3 py-5 bg-slate-100 dark:bg-slate-600 dark:text-slate-100 rounded-xl"
                            type="text" placeholder="{{ __('Message') }}" style="resize: none;"></textarea>
                    </div>
                    <div class="flex justify-center pt-1 ps-7" title="Enviar mensaje" wire:click="sendMessage()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="text-white bg-indigo-600 rounded-full w-22 h-14 hover:cursor-pointer border-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </div>
                </div>
            @endempty
        </div>
        <!-- end chat -->
        </div>
    </div>
</div>
