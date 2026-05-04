<x-layout>
    <x-form title="Register an account" description="Start traking your Ideas Today">
        <form action="/register" method="POST" class="mt-10 space-w-4">
            @csrf
            <!-- <div class="space-y-2">
                <label for="name" class="label">Name</label>
                <input type="text" class="input" id="name" name="name">
            </div> -->
            <x-form.field label="Name" name="name"></x-form.field>
            <x-form.field label="Email" name="email" type="email"></x-form.field>
            <x-form.field label="Password" name="password" type="password"></x-form.field>


            <button type="submit" class="btn mt-6 h-10 w-full">Create Account</button>
        </form>
    </x-form>
</x-layout>