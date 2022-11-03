<div id="notification-content" class="fixed top-[100px] md:top-[60px] right-1" style="display: none">
    <div class="py-4 w-full md:w-[26rem] rounded-md bg-white shadow-md border border-gray-200">
        <p class="px-4 pb-2 font-medium text-lg text-gray-600">Notification</p>
        <hr>
        <ul>
            @if (count($user['notifications']) < 1)
                <li class="px-4 py-2 hover:bg-gray-100 border-b">Saat ini tidak ada notifikasi</li>
            @endif
            @foreach ($user['notifications']->take(6) as $item)
                <li onclick="notificationView({{ $item['id'] }},{{ $user->id }})"
                    class="px-4 py-2 hover:bg-gray-100 border-b @if (!$item['has_been_view']) border-l-4 border-l-blue-500 @endif">
                    {!! $item['message'] !!}
                    <p class="text-xs text-gray-500">{{ Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
