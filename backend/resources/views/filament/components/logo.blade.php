<div class="flex items-center gap-3 group">
    <div class="w-10 h-10">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-[0_0_8px_rgba(197,160,89,0.5)]">
            <defs>
                <linearGradient id="goldGradientLogo" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#C5A059;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#8e703f;stop-opacity:1" />
                </linearGradient>
            </defs>
            <circle cx="50" cy="50" r="45" fill="none" stroke="url(#goldGradientLogo)" stroke-width="2" stroke-dasharray="10 5" opacity="0.3" class="animate-spin-slow" />
            <path d="M20,50 Q50,20 80,50 Q50,80 20,50" fill="none" stroke="url(#goldGradientLogo)" stroke-width="5" stroke-linecap="round" />
            <circle cx="50" cy="50" r="12" fill="#002366" stroke="url(#goldGradientLogo)" stroke-width="2" />
            <circle cx="50" cy="50" r="5" fill="url(#goldGradientLogo)" />
        </svg>
    </div>
    <span class="text-xl font-black tracking-tighter text-white uppercase transition-colors group-hover:text-brand-gold">
        Global<span class="text-brand-gold">Line</span>
    </span>
</div>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 10s linear infinite;
        transform-origin: center;
    }
</style>
