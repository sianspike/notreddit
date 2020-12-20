<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('posts.index') }}">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600"></x-application-logo>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Navbar items -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.create') }}">Create Post</a>
                </li>

                <!-- Notifications dropdown -->
                <li class="nav-item dropdown" id="notifications">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Notifications <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="notification-dropdown">
                        @foreach($notifications as $notification)
                            @if($notification -> user_id != Auth::user() -> id && $notification -> recipient_id == Auth::user() -> id)
                                <li>{{ $notification -> data }}</li>
                                <form method="POST" action="{{ route('notifications.destroy', ['notification' => $notification]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="text-decoration: underline">Mark as read</button>
                                </form>
                                <hr>
                            @endif
                        @endforeach
                    </ul>
                </li>

                <!-- User dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit">Logout</button>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    const notificationsWrapper = $('#notifications');
    const notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    const notificationsCountElem = notificationsToggle.find('i[data-count]');
    let notificationsCount = parseInt(notificationsCountElem.data('count'));
    const notifications = notificationsWrapper.find('#notification-dropdown');

    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
    }
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    const pusher = new Pusher('740963311434c70e9665', {
        cluster: 'eu'
    });

    const channel = pusher.subscribe('notreddit-notifications');
    channel.bind('user-commented', function(data) {

        const existingNotifications = notifications.html();
        const newNotificationHtml = `
          <li>
              <strong class="notification-title">` + data.message + `</strong>
              <!--p class="notification-desc">Extra description can go here</p-->
              <div class="notification-meta">
                  <small class="timestamp">about a minute ago</small>
              </div>
          </li>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });
</script>
