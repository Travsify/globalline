<div id="gl-login-container" style="display: flex !important; flex-direction: row !important; min-height: 100vh !important; width: 100% !important; margin: 0 !important; padding: 0 !important; background: #ffffff !important; overflow-x: hidden !important; position: fixed !important; inset: 0 !important; z-index: 1000 !important;">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap');
        
        #gl-login-container {
            --brand-navy: #0E1B3D;
            --brand-navy-light: #1A2B56;
            --brand-gold: #C5A059;
            --brand-gold-dim: rgba(197, 160, 89, 0.15);
            font-family: 'Inter', sans-serif !important;
        }
        
        .gl-side-left {
            display: none !important;
            flex: 1 !important;
            background: var(--brand-navy) !important;
            position: relative !important;
            overflow: hidden !important;
            padding: 4rem !important;
            flex-direction: column !important;
            justify-content: center !important;
        }
        @media (min-width: 1024px) {
            .gl-side-left { display: flex !important; }
        }
        
        .gl-side-right {
            flex: 1 !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 2rem !important;
            background: #fafbfc !important;
            position: relative !important;
        }
        @media (min-width: 1024px) {
            .gl-side-right { flex: 0 0 520px !important; }
        }
        
        /* Grid background effect */
        .gl-bg-grid {
            position: absolute;
            inset: 0;
            opacity: 0.04;
            pointer-events: none;
            background-image: 
                linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        
        /* Animated pulse rings */
        .gl-pulse-ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(197, 160, 89, 0.15);
            animation: gl-pulse 4s ease-in-out infinite;
        }
        @keyframes gl-pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.05); opacity: 0.6; }
        }
        
        /* Form Styles */
        .fi-fo-field-ctn { margin-top: 1rem !important; width: 100% !important; }
        .fi-input-wrp {
            border-radius: 1rem !important;
            background: #ffffff !important;
            border: 1.5px solid #e8ecf1 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03) !important;
        }
        .fi-input-wrp:focus-within {
            border-color: var(--brand-gold) !important;
            box-shadow: 0 0 0 4px var(--brand-gold-dim), 0 2px 8px rgba(0,0,0,0.06) !important;
            background: #ffffff !important;
        }
        .fi-input { font-weight: 600 !important; color: var(--brand-navy) !important; }
        
        /* Primary Button */
        .fi-btn-color-primary {
            background: var(--brand-navy) !important;
            color: white !important;
            border-radius: 1rem !important;
            padding: 1rem !important;
            font-weight: 800 !important;
            font-size: 0.7rem !important;
            letter-spacing: 0.15em !important;
            text-transform: uppercase !important;
            width: 100% !important;
            box-shadow: 0 4px 16px rgba(14, 27, 61, 0.25) !important;
            transition: all 0.3s !important;
        }
        .fi-btn-color-primary:hover {
            background: var(--brand-gold) !important;
            color: var(--brand-navy) !important;
            box-shadow: 0 6px 24px rgba(197, 160, 89, 0.35) !important;
            transform: translateY(-1px) !important;
        }
        
        /* Labels */
        .fi-fo-field-wrp label {
            font-size: 0.625rem !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.2em !important;
            color: var(--brand-navy) !important;
            font-style: italic !important;
        }
        
        /* Checkbox */
        .fi-checkbox-input:checked {
            background-color: var(--brand-gold) !important;
            border-color: var(--brand-gold) !important;
        }
        
        /* Floating particles animation */
        @keyframes gl-float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-12px) rotate(2deg); }
            66% { transform: translateY(6px) rotate(-1deg); }
        }
        .gl-float { animation: gl-float 8s ease-in-out infinite; }
        .gl-float-delay { animation: gl-float 10s ease-in-out 2s infinite; }
        
        /* Status badge pulse */
        @keyframes gl-badge-pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.4); }
            50% { box-shadow: 0 0 0 6px rgba(74, 222, 128, 0); }
        }
    </style>

    <!-- Left Side: Security Operations Visualization -->
    <div class="gl-side-left">
        <div class="gl-bg-grid"></div>
        
        <!-- Decorative pulse rings -->
        <div class="gl-pulse-ring" style="width: 300px; height: 300px; top: 15%; left: -5%;"></div>
        <div class="gl-pulse-ring" style="width: 200px; height: 200px; bottom: 20%; right: 10%; animation-delay: 2s;"></div>
        
        <!-- Floating elements -->
        <div class="gl-float" style="position: absolute; top: 12%; right: 15%; width: 80px; height: 80px; background: rgba(197, 160, 89, 0.06); border: 1px solid rgba(197, 160, 89, 0.12); border-radius: 1.5rem; backdrop-filter: blur(8px);"></div>
        <div class="gl-float-delay" style="position: absolute; bottom: 25%; left: 8%; width: 50px; height: 50px; background: rgba(255,255,255, 0.03); border: 1px solid rgba(255,255,255, 0.06); border-radius: 1rem; backdrop-filter: blur(8px);"></div>

        <div style="position: relative; z-index: 10; max-width: 480px;">
            <!-- Top Badge -->
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(197, 160, 89, 0.1); border: 1px solid rgba(197, 160, 89, 0.2); border-radius: 2rem; margin-bottom: 2.5rem;">
                <span style="height: 6px; width: 6px; border-radius: 50%; background: #4ade80; animation: gl-badge-pulse 2s infinite;"></span>
                <span style="font-size: 0.6rem; font-weight: 800; color: var(--brand-gold); text-transform: uppercase; letter-spacing: 0.25em; font-style: italic;">Ops Terminal v5.0</span>
            </div>

            <!-- Hero Text -->
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 3.5rem; font-weight: 900; line-height: 1.05; letter-spacing: -0.04em; color: white !important; margin: 0; text-transform: uppercase;">
                Command<br/>
                <span style="color: var(--brand-gold) !important; font-style: italic;">Operations.</span>
            </h1>
            <p style="font-size: 1.1rem; color: rgba(255,255,255,0.35) !important; max-width: 400px; margin-top: 1.5rem; line-height: 1.7; font-style: italic;">
                The unified admin terminal for global supply chain oversight, compliance decisioning, and financial settlements.
            </p>
            
            <!-- Capability Tags -->
            <div style="margin-top: 3rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                <span style="padding: 0.4rem 0.8rem; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.5rem; font-size: 0.6rem; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700;">KYB Review</span>
                <span style="padding: 0.4rem 0.8rem; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.5rem; font-size: 0.6rem; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700;">Payments Ops</span>
                <span style="padding: 0.4rem 0.8rem; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.5rem; font-size: 0.6rem; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700;">Logistics</span>
                <span style="padding: 0.4rem 0.8rem; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.5rem; font-size: 0.6rem; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700;">RBAC</span>
            </div>
            
            <!-- System Status Cards -->
            <div style="margin-top: 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                <div style="padding: 1rem; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); border-radius: 1rem;">
                    <span style="font-size: 1.75rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif;">7</span>
                    <p style="font-size: 0.55rem; font-weight: 700; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 0.2em; margin-top: 0.25rem;">Admin Roles</p>
                </div>
                <div style="padding: 1rem; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); border-radius: 1rem;">
                    <span style="font-size: 1.75rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif;">256</span>
                    <p style="font-size: 0.55rem; font-weight: 700; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 0.2em; margin-top: 0.25rem;">Bit Encryption</p>
                </div>
            </div>
        </div>
        
        <!-- Bottom decorations -->
        <div style="position: absolute; bottom: -4rem; right: -4rem; width: 16rem; height: 16rem; background: var(--brand-gold); opacity: 0.04; filter: blur(80px); border-radius: 50%;"></div>
        <div style="position: absolute; top: -4rem; left: -4rem; width: 12rem; height: 12rem; background: #3b82f6; opacity: 0.03; filter: blur(80px); border-radius: 50%;"></div>
        
        <!-- Footer tag -->
        <div style="position: absolute; bottom: 2rem; left: 4rem; display: flex; align-items: center; gap: 0.75rem;">
            <span style="font-size: 0.55rem; font-weight: 800; color: rgba(255,255,255,0.15); text-transform: uppercase; letter-spacing: 0.3em; font-style: italic;">SecNode: 0xAF2 • AES-256</span>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="gl-side-right">
        <div style="width: 100%; max-width: 380px;">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-8" style="color: var(--brand-navy) !important;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                    <div style="width: 40px; height: 40px; background: var(--brand-navy); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: var(--brand-gold);" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    </div>
                    <div>
                        <span style="font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 1.25rem; text-transform: uppercase; letter-spacing: -0.03em;">GlobalLine</span>
                        <span style="display: block; font-size: 0.55rem; font-weight: 700; color: var(--brand-gold); text-transform: uppercase; letter-spacing: 0.2em;">Admin Ops</span>
                    </div>
                </div>
            </div>
            
            <!-- Form Header -->
            <div style="margin-bottom: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--brand-gold);"></div>
                    <span style="font-size: 0.6rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.25em; color: var(--brand-gold); font-style: italic;">Secure Access</span>
                </div>
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 900; color: var(--brand-navy) !important; letter-spacing: -0.04em; margin: 0; text-transform: uppercase;">
                    Command <span style="color: var(--brand-gold) !important; font-style: italic;">Access.</span>
                </h2>
                <p style="color: #94a3b8; font-size: 0.875rem; margin-top: 0.5rem; font-style: italic;">Enter your admin credentials to access operations.</p>
            </div>

            <!-- Filament Form -->
            <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 1rem;">
                {{ $this->form }}

                <div style="margin-top: 1.5rem;">
                    <x-filament-panels::form.actions
                        :actions="$this->getCachedFormActions()"
                        :full-width="true"
                    />
                </div>
            </form>

            <!-- Footer -->
            <div style="margin-top: 3.5rem; padding-top: 2rem; border-top: 1px solid #f1f5f9;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <p style="font-size: 0.6rem; color: #cbd5e1; text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700; font-style: italic;">
                        &copy; 2026 GlobalLine Ops
                    </p>
                    <div style="display: flex; align-items: center; gap: 0.4rem;">
                        <span style="width: 5px; height: 5px; border-radius: 50%; background: #22c55e;"></span>
                        <span style="font-size: 0.55rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;">Secure</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Corner Auth Server Tag -->
        <div style="position: absolute; top: 1.5rem; right: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <span style="font-size: 0.5rem; font-weight: 800; color: #d1d5db; text-transform: uppercase; letter-spacing: 0.15em; font-style: italic;">Admin Panel</span>
            <div style="width: 6px; height: 6px; border-radius: 50%; background: #3b82f6;"></div>
        </div>
    </div>
</div>
