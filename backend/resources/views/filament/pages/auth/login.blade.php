<x-filament-panels::layout.base>
    <div class="flex min-h-screen bg-white">
        <!-- Left Side: Illustration / Brand Content -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <div class="absolute inset-0 h-full w-full bg-[#002366] overflow-hidden">
                <!-- Abstract Trade Background -->
                <div class="absolute inset-0 opacity-20">
                    <svg viewBox="0 0 100 100" class="h-full w-full">
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                        <rect width="100" height="100" fill="url(#grid)" />
                    </svg>
                </div>
                
                <!-- Brand Overlay Content -->
                <div class="relative flex h-full flex-col justify-center px-12 text-white">
                    <div class="mb-8">
                         @include('filament.components.logo')
                    </div>
                    <h1 class="text-5xl font-black tracking-tight leading-tight">
                        Global Trade <br/> 
                        <span class="text-[#C5A059]">Intelligence Terminal</span>
                    </h1>
                    <p class="mt-4 text-xl text-gray-300 max-w-lg">
                        Manage supply chains, settlements, and physical nodes from the GlobalLine Unified Command Center.
                    </p>
                    
                    <div class="mt-12 flex gap-4">
                        <div class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm backdrop-blur-md border border-white/10">
                            <span class="h-2 w-2 rounded-full bg-green-400"></span>
                            Live Market Feed Active
                        </div>
                        <div class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm backdrop-blur-md border border-white/10">
                            <span class="h-2 w-2 rounded-full bg-[#C5A059]"></span>
                            Node Sync: 100%
                        </div>
                    </div>
                </div>

                <!-- Decorative Elements -->
                <div class="absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-[#C5A059] opacity-10 blur-3xl"></div>
                <div class="absolute top-1/4 -right-24 h-64 w-64 rounded-full bg-blue-400 opacity-10 blur-3xl"></div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <div class="lg:hidden mb-8">
                         @include('filament.components.logo')
                    </div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-[#002366]">Command Access</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Enter your credentials to access the terminal.
                    </p>
                </div>

                <div class="mt-10">
                     <form wire:submit="authenticate" class="space-y-6">
                        {{ $this->form }}

                        <x-filament-panels::form.actions
                            :actions="$this->getCachedFormActions()"
                            :full-width="$this->hasFullWidthFormActions()"
                        />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::layout.base>

<style>
    /* Customizing Filament Form for Argon Look */
    .fi-fo-field-ctn {
        @apply space-y-2 !important;
    }
    
    .fi-input-wrp {
        @apply border-gray-200 bg-gray-50 transition-all focus-within:bg-white focus-within:ring-2 focus-within:ring-[#C5A059]/20 !important;
        border-radius: 0.75rem !important;
    }

    .fi-btn-color-primary {
        background: linear-gradient(to right, #002366, #003399) !important;
        @apply rounded-xl font-bold py-3 transition-transform active:scale-95 !important;
        box-shadow: 0 4px 15px rgba(0, 35, 102, 0.2) !important;
    }
</style>
