<x-layout>
    <x-form title="Login" description="Glad to have you back">
        <form action="/login" method="POST" class="mt-10 space-w-4">
            @csrf
            <x-form.field label="Email" name="email" type="email"></x-form.field>
            <x-form.field label="Password" name="password" type="password"></x-form.field>

            <button type="submit" class="btn mt-6 h-10 w-full">Login</button>
        </form>
    </x-form>
</x-layout>