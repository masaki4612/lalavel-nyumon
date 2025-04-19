<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- 検索フォーム -->
                    <div class="mb-6" x-data="{
                        search: '',
                        clients: {{ $clients->toJson() }},
                        selectedClient: null,
                        filteredClients: [],
                        showResults: false,
                        selectClient(client) {
                            this.selectedClient = client;
                            this.search = client.name;
                            this.showResults = false;
                            this.$refs.form.submit();
                        },
                        filterClients() {
                            if (!this.search) {
                                this.filteredClients = [];
                                return;
                            }
                            this.filteredClients = this.clients.filter(client => 
                                client.name.toLowerCase().includes(this.search.toLowerCase())
                            ).slice(0, 5);
                            this.showResults = true;
                        }
                    }">
                        <form x-ref="form" method="GET" action="{{ route('projects.index') }}" class="relative">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 max-w-xs relative">
                                    <input
                                        type="text"
                                        name="search"
                                        x-model="search"
                                        @keyup="filterClients"
                                        @click.outside="showResults = false"
                                        placeholder="クライアント名で検索..."
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    >
                                    <input type="hidden" name="client_id" :value="selectedClient ? selectedClient.id : ''">
                                    
                                    <!-- サジェスト結果 -->
                                    <div
                                        x-show="showResults && filteredClients.length > 0"
                                        class="absolute z-50 w-full mt-1 bg-white rounded-md shadow-lg border border-gray-200"
                                    >
                                        <ul class="max-h-60 overflow-auto">
                                            <template x-for="client in filteredClients" :key="client.id">
                                                <li
                                                    @click="selectClient(client)"
                                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-sm"
                                                    x-text="client.name"
                                                >
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>

                                @if(request('client_id'))
                                    <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-900">
                                        検索をクリア
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    クライアント
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    プロジェクト名
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    カテゴリー
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    開始日
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    内容
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    メモ
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($projects as $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($project->client)
                                        <a href="{{ route('clients.show', $project->client) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $project->client->name }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">未設定</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-900">
                                        {{ $project->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->start_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->content }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->memo }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>    
                    </table>

                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 