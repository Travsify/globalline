<div id="gl-login-root">
    <style>
        #gl-login-root {
            --brand-navy: #002366;
            --brand-gold: #C5A059;
        }
        .gl-login-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            background: #ffffff;
            font-family: 'Inter', sans-serif;
        }
        .gl-side-left {
            display: none;
            flex: 1;
            background: var(--brand-navy);
            position: relative;
            overflow: hidden;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 4rem;
        }
        @media (min-width: 1024px) {
            .gl-side-left {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
        }
        .gl-side-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background: white;
        }
        @media (min-width: 1024px) {
            .gl-side-right {
                flex: 0 0 550px;
            }
        }
        .gl-form-container {
            width: 100%;
            max-width: 400px;
        }
        .gl-bg-grid {
            position: absolute;
            inset: 0;
            opacity: 0.15;
            pointer-events: none;
        }
        .gl-login-title {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.04em;
        }
        .gl-login-desc {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.7);
            max-width: 480px;
            margin-bottom: 3rem;
        }
        .gl-status-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
            font-size: 0.875rem;
            backdrop-filter: blur(10px);
        }
        .gl-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        
        /* Form Overrides */
        .fi-input-wrp {
            border-radius: 0.75rem !important;
            background: #f9fafb !important;
            border: 1px solid #e5e7eb !important;
            transition: all 0.2s !important;
        }
        .fi-input-wrp:focus-within {
            background: white !important;
            border-color: var(--brand-gold) !important;
            box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1) !important;
        }
        .fi-btn-color-primary {
            background: linear-gradient(135deg, var(--brand-navy), #003399) !important;
            border-radius: 0.75rem !important;
            padding: 0.75rem !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 12px rgba(0, 35, 102, 0.15) !important;
        }
        
        /* Logo adjustment */
        .gl-logo-scale .w-10 { width: 50px !important; height: 50px !important; }
        .gl-logo-scale .text-xl { font-size: 1.75rem !important; }
        
        @keyframes gl-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: gl-float 4s ease-in-out infinite; }
    </style>

    <x-filament-panels::layout.base>
        <div class="gl-login-wrapper">
            <!-- Left Side -->
            <div class="gl-side-left">
                <div class="gl-bg-grid">
                    <svg width="100%" height="100%"><pattern id="gl-grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern><rect width="100%" height="100%" fill="url(#gl-grid)" /></svg>
                </div>
                
                <div class="relative z-10">
                    <div class="gl-logo-scale mb-12">
                        @include('filament.components.logo')
                    </div>
                    
                    <h1 class="gl-login-title">
                        Global Trade<br/>
                        <span style="color: var(--brand-gold)">Intelligence Terminal</span>
                    </h1>
                    
                    <p class="gl-login-desc">
                        Redefining supply chain visibility and settlement intelligence for the modern trade era.
                    </p>
                    
                    <div style="display: flex; gap: 1rem;">
                        <div class="gl-status-badge">
                            <span class="gl-dot" style="background: #4ade80;"></span>
                            Live Market Feed
                        </div>
                        <div class="gl-status-badge">
                            <span class="gl-dot" style="background: var(--brand-gold);"></span>
                            Node Sync Active
                        </div>
                    </div>
                </div>
                
                <!-- Floating Elements -->
                <div style="position: absolute; bottom: 10%; right: 10%; width: 15rem; height: 15rem; background: var(--brand-gold); opacity: 0.1; filter: blur(80px); border-radius: 50%;"></div>
                <div style="position: absolute; top: 10%; left: -5%; width: 20rem; height: 20rem; background: #3b82f6; opacity: 0.1; filter: blur(100px); border-radius: 50%;"></div>
            </div>

            <!-- Right Side -->
            <div class="gl-side-right">
                <div class="gl-form-container">
                    <div class="lg:hidden mb-10 gl-logo-scale" style="color: var(--brand-navy)">
                        @include('filament.components.logo')
                    </div>
                    
                    <div class="mb-8">
                        <h2 style="font-size: 2rem; font-weight: 800; color: var(--brand-navy); letter-spacing: -0.03em;">Command Access</h2>
                        <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">Enter credential-alpha to access the terminal.</p>
                    </div>
                    
                    <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        {{ $this->form }}

                        <div style="margin-top: 0.5rem;">
                            <x-filament-panels::form.actions
                                :actions="$this->getCachedFormActions()"
                                :full-width="$this->hasFullWidthFormActions()"
                            />
                        </div>
                    </form>
                    
                    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #f3f4f6; text-align: center;">
                        <p style="font-size: 0.75rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em;">
                            &copy; 2026 GlobalLine Intelligence Systems
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-filament-panels::layout.base>
</div>
