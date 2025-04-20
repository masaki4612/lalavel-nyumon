<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('projects.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← プロジェクト一覧に戻る
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                                    プロジェクト名
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    クライアント
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($project->client)
                                        <a href="{{ route('clients.show', $project->client) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $project->client->name }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">未設定</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    カテゴリー
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->category->name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    開始日
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->start_date }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    内容
                                </th>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {!! nl2br(e($project->content)) !!}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    メモ
                                </th>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {!! nl2br(e($project->memo)) !!}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    担当者
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @foreach($project->users as $user)
                                        {{ $user->name }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    

                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('projects.edit', $project) }}"
                            class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            編集する
                        </a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST"
                            onsubmit="return confirm('本当に削除しますか？');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                削除する
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 