<x-filament-panels::layout.base>
    <div id="gl-login-container" style="display: flex !important; flex-direction: row !important; min-height: 100vh !important; width: 100% !important; margin: 0 !important; padding: 0 !important; background: #ffffff !important; overflow-x: hidden !important;">
        <style>
            #gl-login-container {
                --brand-navy: #002366;
                --brand-gold: #C5A059;
                font-family: 'Inter', sans-serif !important;
            }
            .gl-side-left {
                display: none !important;
                flex: 1 !important;
                background: var(--brand-navy) !important;
                position: relative !important;
                overflow: hidden !important;
                padding: 5rem !important;
                flex-direction: column !important;
                justify-content: center !important;
            }
            @media (min-width: 1024px) {
                .gl-side-left {
                    display: flex !important;
                }
            }
            .gl-side-right {
                flex: 1 !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                padding: 2rem !important;
                background: white !important;
            }
            @media (min-width: 1024px) {
                .gl-side-right {
                    flex: 0 0 500px !important;
                }
            }
            .gl-login-btn {
                background: linear-gradient(135deg, var(--brand-navy), #003399) !important;
                color: white !important;
                border-radius: 0.75rem !important;
                padding: 0.875rem !important;
                font-weight: 700 !important;
                width: 100% !important;
                border: none !important;
                cursor: pointer;
                transition: transform 0.2s;
            }
            .gl-login-btn:hover { transform: translateY(-2px); }

            /* Fix Filament Form Scaling */
            .fi-fo-field-ctn { margin-top: 1.25rem !important; width: 100% !important; }
            .fi-input-wrp {
                border-radius: 0.75rem !important;
                background: #f9fafb !important;
                border: 1px solid #e5e7eb !important;
            }
            
            /* Logo sizing */
            .gl-logo-hero svg { width: 60px !important; height: 60px !important; }
            .gl-logo-hero span { font-size: 2.5rem !important; }
            .gl-logo-form svg { width: 40px !important; height: 40px !important; }
            .gl-logo-form span { font-size: 1.5rem !important; }
            
            .gl-bg-grid {
                position: absolute;
                inset: 0;
                opacity: 0.1;
                pointer-events: none;
            }
        </style>

        <!-- Left Side: Hero Section -->
        <div class="gl-side-left">
            <div class="gl-bg-grid">
                <svg width="100%" height="100%"><pattern id="gl-grid-p" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="white" stroke-width="1"/></pattern><rect width="100%" height="100%" fill="url(#gl-grid-p)" /></svg>
            </div>
            
            <div style="position: relative; z-index: 10;">
                <div class="gl-logo-hero mb-8" style="color: white !important;">
                    @include('filament.components.logo')
                </div>
                
                <h1 style="font-size: 3.5rem; font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; color: white !important;">
                    Global Trade<br/>
                    <span style="color: var(--brand-gold) !important;">Intelligence</span>
                </h1>
                <p style="font-size: 1.25rem; color: rgba(255,255,255,0.7) !important; max-width: 400px; margin-top: 1.5rem;">
                    The Unified Command Center for supply chain visibility and secure settlements.
                </p>
                
                <div style="margin-top: 3rem; display: flex; gap: 1rem;">
                    <div style="padding: 0.5rem 1rem; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.1); border-radius: 2rem; font-size: 0.875rem; color: white;">
                        Live Market Sync: <span style="color: #4ade80;">Online</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="gl-side-right">
            <div style="width: 100%; max-width: 360px;">
                <div class="lg:hidden mb-8 gl-logo-form" style="color: var(--brand-navy) !important;">
                    @include('filament.components.logo')
                </div>
                
                <div class="mb-8">
                    <h2 style="font-size: 1.875rem; font-weight: 800; color: var(--brand-navy) !important; letter-spacing: -0.025em;">Secure Login</h2>
                    <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">Access the GlobalLine Intelligence Terminal.</p>
                </div>

                <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 1rem;">
                    {{ $this->form }}

                    <div style="margin-top: 1.5rem;">
                        <x-filament-panels::form.actions
                            :actions="$this->getCachedFormActions()"
                            :full-width="true"
                        />
                    </div>
                </form>

                <p style="margin-top: 3rem; font-size: 0.75rem; color: #9ca3af; text-align: center; text-transform: uppercase; letter-spacing: 0.1em;">
                    &copy; 2026 Intelligence Operations
                </p>
            </div>
        </div>
    </div>
</x-filament-panels::layout.base>
