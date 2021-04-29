<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md p-6">
            <div class="flex items-center justify-between flex-wrap mb-4">
                <div class="flex-grow sm:mr-3 w-auto">
                    <input class="w-full border-2 border-gray-300 h-12" type="search" placeholder="Suche nach Dateien und Ordnern">
                </div>
                <div class="mt-4 sm:mt-0">
                    <button class="bg-gray-200 h-12 px-6 mr-2 mb-2 sm:mb-0" wire:click="$set('creatingNewFolder', true)">
                        Neuer Ordner
                    </button>
                    <button class="bg-blue-600 h-12 px-6 text-white font-bold">
                        Datei hochladen
                    </button>
                </div>
            </div>

            <div>
                <div class="py-2 px-3">
                    <div class="flex items-center">
                        @foreach($ancestors as $ancestor)
                            <a href="" class="font-bold text-gray-400">
                                {{ $ancestor->objectable->name }}
                            </a>

                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 36.5 60.5" enable-background="new 0 0 36.5 60.5" xml:space="preserve" fill="currentColor" class="text-gray-100 w-5 h-3 mx-1">
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#3E3E3E" d="M7.8,3.8l26.6,26.5c0.3,0.3,0.3,0.8,0,1.2L7.8,58.1
                                    c-0.3,0.2-0.7,0.2-1.1,0l-3.4-3.5l23.2-23.1c0.2-0.3,0.2-0.8,0-1.2L3.3,7.3l3.4-3.5C7,3.5,7.4,3.5,7.8,3.8L7.8,3.8z"/>
                            </svg>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if($creatingNewFolder)
            <div class="bg-white overflow-hidden shadow-md p-6 mt-1 hover:bg-blue-300">
                <form class="flex items-center flex-wrap sm:flex-nowrap" wire:submit.prevent="createFolder">
                    <input type="text" class="w-full border-2 border-gray-300 h-12 sm:mr-3 mb-3 sm:mb-0" wire:model="newFolderState.name">
                    <div class="flex-none">
                        <button type="submit" class="whitespace-nowrap bg-blue-600 h-12 px-6 text-white font-bold mr-2">
                            Ordner anlegen
                        </button>
                    </div>
                    <button wire:click="$set('creatingNewFolder', false)" type="submit" class="bg-gray-200 h-12 px-6 font-bold">
                        Abbrechen
                    </button>
                </form>
            </div>
        @endif
        @foreach($object->children as $child)
            <div class="bg-white overflow-hidden shadow-md p-6 mt-1 hover:bg-blue-300">
                <div class="flex items-center justify-between flex-wrap px-3">
                    <div class="flex items-center w-2/5 p-3">
                        @if($child->objectable_type === 'file')
                            <svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-700 feather feather-file-text w-7 h-7 mx-1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        @endif

                        @if($child->objectable_type === 'folder')
                            <svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-700 feather feather-folder w-7 h-7 mx-1"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        @endif

                        @if($child->objectable_type === 'folder')
                            <a href="{{ route('files', ['uuid' => $child->uuid]) }}" class="font-bold text-lg text-blue-600">
                                {{ $child->objectable->name }}
                            </a>
                        @endif

                        @if($child->objectable_type === 'file')
                            <a href="" class="font-bold text-lg text-blue-600">
                                {{ $child->objectable->name }}
                            </a>
                        @endif
                    </div>
                    @if($child->objectable_type === 'file')
                    <div class="p-3">{{ $child->objectable->size }}</div>
                    @else
                    <div class="p-3">&mdash;</div>
                    @endif
                    <div class="p-3">{{ $child->created_at }}</div>
                    <div class="p-3">
                        <div class="">
                            <button class="mr-2 bg-gray-200 h-7 px-3">Umbennenen</button>
                            <button class="text-white font-bold bg-red-600 h-7 px-3">Löschen</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($object->children->count() === 0)
            <div class="bg-white overflow-hidden shadow-md p-6 mt-1">
                <div class="flex justify-evenly h-12">
                    <div class="font-bold">
                        Dieser Ordner ist Leer!
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
