<x-filament-panels::layout.base>
    <div class="gl-login-container">
        <!-- Left Side: Illustration / Brand Content -->
        <div class="gl-login-left">
            <!-- Abstract Trade Background Grid -->
            <div class="absolute inset-0 opacity-20" style="pointer-events: none;">
                <svg viewBox="0 0 100 100" style="width: 100%; height: 100%;">
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                    <rect width="100" height="100" fill="url(#grid)" />
                </svg>
            </div>
            
            <div class="gl-login-content">
                <div class="gl-login-logo mb-12">
                     @include('filament.components.logo')
                </div>
                <h1 class="gl-login-title">
                    Global Trade<br/> 
                    <span style="color: #C5A059;">Intelligence Terminal</span>
                </h1>
                <p class="gl-login-subtitle">
                    Manage supply chains, settlements, and physical nodes from the GlobalLine Unified Command Center.
                </p>
                
                <div style="margin-top: 3rem; display: flex; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; border-radius: 9999px; background-color: rgba(255,255,255,0.1); padding: 0.5rem 1rem; font-size: 0.875rem; backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1);">
                        <span style="height: 0.5rem; width: 0.5rem; border-radius: 9999px; background-color: #4ade80;"></span>
                        Live Market Feed
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; border-radius: 9999px; background-color: rgba(255,255,255,0.1); padding: 0.5rem 1rem; font-size: 0.875rem; backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1);">
                        <span style="height: 0.5rem; width: 0.5rem; border-radius: 9999px; background-color: #C5A059;"></span>
                        Node Sync: 100%
                    </div>
                </div>
            </div>

            <!-- Decorative Glows -->
            <div style="position: absolute; bottom: -6rem; left: -6rem; height: 24rem; width: 24rem; border-radius: 9999px; background-color: #C5A059; opacity: 0.1; filter: blur(64px);"></div>
            <div style="position: absolute; top: 25%; right: -6rem; height: 16rem; width: 16rem; border-radius: 9999px; background-color: #3b82f6; opacity: 0.1; filter: blur(64px);"></div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="gl-login-right">
            <div style="width: 100%; max-width: 400px; margin-left: auto; margin-right: auto;">
                <div class="lg:hidden mb-8 gl-login-logo" style="color: #002366;">
                     @include('filament.components.logo')
                </div>
                
                <h2 style="font-size: 1.875rem; font-weight: 800; color: #002366; letter-spacing: -0.025em;">Command Access</h2>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;">
                    Enter your credentials to access the terminal.
                </p>

                <div style="margin-top: 2.5rem;">
                     <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 1.5rem;">
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
