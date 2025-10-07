<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      タグ: #{{ $tag->name }}
    </h2>
  </x-slot>

  <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    @forelse ($tweets as $tweet)
      <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-4">
        <p class="text-lg text-gray-900 dark:text-gray-100">{{ $tweet->tweet }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">投稿者: {{ $tweet->user->name }}</p>
        <a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:underline mt-2 inline-block">詳細を見る</a>
      </div>
    @empty
      <p class="text-gray-600 dark:text-gray-400">このタグに関連するツイートはありません。</p>
    @endforelse
  </div>
</x-app-layout>