<nav class="border-b border-border px-6 ">
    <div class="max-w-7x1 mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/" class="flex gap-4 items-center ">
                <img class="h-10" src="{{ asset('images/idea.png') }}" />
            </a>
        </div>
        <div class="flex gap-4 items-center ">
            @guest
                <a href="/login">Sign in</a>
                <a href="/register" class="btn">Register</a>
            @endguest
            @auth
                <form action="/logout" method="post">
                    <button type="submit">logout</button>
                </form>

            @endauth
        </div>
    </div>
</nav>