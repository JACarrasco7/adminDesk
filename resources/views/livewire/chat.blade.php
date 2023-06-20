<div>
    <!-- Chatting -->
    <div class="flex flex-row justify-between h-[50rem] bg-white dark:bg-gray-800">
        <!-- chat list -->
        <div class="flex flex-col w-2/5 border-r-2 border-slate-700 overflow-y-auto">
            <!-- search compt -->
            <div class="py-4 px-2">
                <input type="text" placeholder="{{ __('Search chatting') }}"
                    class="py-2 px-2 rounded-lg w-full bg-slate-100 dark:bg-slate-600 dark:text-slate-100" />
            </div>
            <!-- end search compt -->
            <!-- user list -->

            @foreach ($users as $user)
                <div wire:click="getReceiveId({{ $user->id }})"
                    class="flex flex-row py-4 px-2 justify-center items-center rounded-l-md hover:bg-slate-700 hover:cursor-pointer">
                    <div class="w-1/4">
                        <img src="https://source.unsplash.com/_7LbC5J-jw4/600x600"
                            class="object-cover h-12 w-12 rounded-full" alt="" />
                    </div>
                    <div class="w-full">
                        <div class="text-lg font-semibold flex justify-between">
                            {{ $user->username }}
                            @if (Helpers::getIsConnected($user->id))
                                <small class="ms-5 text-lime-500">Online</small>
                            @else
                                <small class="ms-5 text-red-600">Disconnected</small>
                            @endif
                        </div>
                        <span class="text-gray-500">Pick me at 9:00 Am</span>
                    </div>
                </div>
            @endforeach
            <!-- end user list -->
        </div>
        <!-- end chat list -->
        <!-- message -->
        <div class="w-full px-5 flex flex-col justify-between">
            @empty($receiver_id)
                <div class="flex h-screen justify-center">
                    <div class="m-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12 m-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3" />
                        </svg>
                        <p class="m-auto text-center mx-64">
                            Conecta con las personas adecuadas con tan solo un click para aumentar tu productividad.
                        </p>
                        <p class="m-auto text-center mx-64 mt-8">
                            <b>AdminDesk</b>
                        </p>
                    </div>
                </div>
            @else
                <div wire:poll.750ms="getConversationWithUser()"
                    class="flex flex-col mt-5 overflow-auto scroll-smooth scrollbar-none">
                    @foreach ($conversationMessages as $conversationMessage)
                        <div
                            class="flex justify-{{ $conversationMessage->transmitter_id == Auth::user()->id ? 'end' : 'star' }} mb-4">
                            <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                {{ $conversationMessage->message }}
                            </div>
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover h-8 w-8 rounded-full" alt="" />
                        </div>
                    @endforeach

                    {{-- <div class="flex justify-start mb-4">
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover h-8 w-8 rounded-full" alt="" />
                            <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat at praesentium, aut ullam
                                delectus odio error sit rem. Architecto nulla doloribus laborum illo rem enim dolor odio
                                saepe,consequatur quas?
                            </div>
                        </div>
                        <div class="flex justify-end mb-4">
                            <div>
                                <div
                                    class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Magnam, repudiandae.
                                </div>

                                <div
                                    class="mt-4 mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Debitis, reiciendis!
                                </div>
                            </div>
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover h-8 w-8 rounded-full" alt="" />
                        </div>
                        <div class="flex justify-start mb-4">
                            <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600"
                                class="object-cover h-8 w-8 rounded-full" alt="" />
                            <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                happy holiday guys!
                            </div>
                        </div> --}}

                </div>
            @endempty

            @empty(!$receiver_id)
                <div class="py-5 grid grid-cols-12">
                    <div class="col-span-11">
                        <textarea wire:model="message" class="w-full bg-slate-100 dark:bg-slate-600 dark:text-slate-100 py-5 px-3 rounded-xl"
                            type="text" placeholder="{{ __('Message') }}" style="resize: none;"></textarea>
                    </div>
                    <div class="flex justify-center pt-1 ps-7" title="Enviar mensaje" wire:click="sendMessage()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-22 h-14 text-white bg-indigo-600 hover:cursor-pointer border-1 rounded-full">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </div>
                </div>
            @endempty
        </div>
        <!-- end message -->
    </div>
</div>
