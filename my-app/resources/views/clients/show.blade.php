<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $client->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('clients.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← クライアント一覧に戻る
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                                    クライアント名
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $client->name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    URL
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ $client->url }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                        {{ $client->url }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    電話番号
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $client->phone }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    住所
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $client->address }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    備考
                                </th>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {!! nl2br(e($client->notes)) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('clients.edit', $client) }}"
                            class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            編集する
                        </a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST"
                            onsubmit="return confirm('本当に削除しますか？');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                削除する
                            </button>
                        </form>
                    </div>

                    <!-- プロジェクト一覧 -->
                    @if($client->projects->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">プロジェクト一覧</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            プロジェクト名
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            開始日
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            カテゴリー
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            備考
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($client->projects as $project)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-900">
                                                    {{ $project->name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $project->start_date }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ optional($project->category)->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $project->memo }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="mt-8 bg-gray-50 p-4 rounded">
                            <p class="text-gray-500">関連するプロジェクトはありません。</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>