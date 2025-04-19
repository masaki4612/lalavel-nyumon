<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('クライアント詳細') }}
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

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">基本情報</h3>
                                <table class="min-w-full">
                                    <tr>
                                        <th class="text-left py-2 px-4 bg-gray-50">クライアント名</th>
                                        <td class="py-2 px-4">{{ $client->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left py-2 px-4 bg-gray-50">メールアドレス</th>
                                        <td class="py-2 px-4">{{ $client->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left py-2 px-4 bg-gray-50">電話番号</th>
                                        <td class="py-2 px-4">{{ $client->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left py-2 px-4 bg-gray-50">住所</th>
                                        <td class="py-2 px-4">{{ $client->address }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold mb-2">備考</h3>
                                <div class="bg-gray-50 p-4 rounded">
                                    {!! nl2br(e($client->notes)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
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
                </div>
            </div>

            <!-- プロジェクト一覧    -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-2">プロジェクト一覧</h3>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left py-2 px-4 bg-gray-50">プロジェクト名</th>
                            <th class="text-left py-2 px-4 bg-gray-50">開始日</th>
                            <th class="text-left py-2 px-4 bg-gray-50">終了日</th>
                            <th class="text-left py-2 px-4 bg-gray-50">ステータス</th>
                            <th class="text-left py-2 px-4 bg-gray-50">備考</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($client->projects as $project)
                        <tr>
                            <td class="py-2 px-4">
                                <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ $project->name }}
                                </a>
                            </td>
                            <td class="py-2 px-4">{{ $project->start_date }}</td>
                            <td class="py-2 px-4">{{ $project->end_date }}</td>
                            <td class="py-2 px-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($project->status == '進行中') bg-green-100 text-green-800 
                                    @elseif($project->status == '完了') bg-blue-100 text-blue-800 
                                    @elseif($project->status == '中断') bg-yellow-100 text-yellow-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td class="py-2 px-4">{{ Str::limit($project->notes, 30) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                                このクライアントに関連するプロジェクトはありません
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>