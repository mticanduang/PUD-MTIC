<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login | PUD-MTIC Portal Ujian Digital</title>
    <link rel="stylesheet" href="<?= base_url('css/output.css') ?>"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet"/>
</head>
<body class="font-display bg-[#f3f4f6] min-h-screen flex items-center justify-center p-4 antialiased text-slate-900 dark:text-slate-100">
    <div class="layout-container w-full max-w-[480px] flex flex-col gap-6">
        <div class="glass-card shadow-2xl rounded-2xl border border-primary/10 dark:border-primary/20 overflow-hidden flex flex-col">
            <div class="pt-10 pb-6 px-8 flex flex-col items-center text-center">
                <div class="w-24 h-24 mb-6 rounded-full bg-white p-2 shadow-md border border-gold-accent/30">
                    <img alt="Logo MTI Canduang" class="w-full h-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB20I1tv_zvvXs0-XZY1ny3Yl_zGCemDwYL9HCqTTFxDYxns3nNG36lqgg9uKJaZDvxnryVYA7zjCCn0IlgpyLLycQ2bYNBEA-F4EFalvWFsOQcCu-QzEDdjj2saOdpAMg3ygCcHUEfyXGyQ9JgaNBZe3IU9KaNHptCu9jWo2UszAzYqtp8OgwwU-gtgsPTs6D24-wMbfCOx6C4OQBHEN98mMA24rTdO5n6qgKQ27b4LN9MddmXvy-tkBjAdbxXaRsJkHmj0yQsXYQ"/>
                </div>
                <h1 class="text-emerald-dark dark:text-emerald-400 text-xl font-bold leading-tight uppercase tracking-wide">
                    Pondok Pesantren MTI Canduang
                </h1>
                <div class="h-1 w-16 bg-gold-accent my-3 rounded-full"></div>
                <h2 class="text-slate-600 dark:text-slate-300 text-base font-medium">
                    Portal Ujian Digital (PUD-MTIC)
                </h2>
            </div>
            <div class="flex border-b border-slate-200 dark:border-slate-800 px-8">
                <button class="flex-1 py-4 text-sm font-bold border-b-2 border-primary text-primary transition-all" type="button" data-tab="santri">
                    SANTRI
                </button>
                <button class="flex-1 py-4 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-all" type="button" data-tab="admin">
                    ADMIN
                </button>
            </div>
            <form class="px-8 pb-10 flex flex-col gap-5" action="<?= base_url('login') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-emerald-dark dark:text-emerald-400 ml-1">Nomor Induk Santri (NIS)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-primary/60 group-focus-within:text-primary">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3.5 bg-background-light dark:bg-background-dark/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-slate-900 dark:text-slate-100 placeholder:text-slate-400" placeholder="Masukkan NIS atau Username Anda" type="text" name="username" required/>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="text-sm font-semibold text-emerald-dark dark:text-emerald-400">Password</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-primary/60 group-focus-within:text-primary">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                        </div>
                        <input class="w-full pl-11 pr-12 py-3.5 bg-background-light dark:bg-background-dark/50 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-slate-900 dark:text-slate-100 placeholder:text-slate-400" placeholder="Masukkan Password" type="password" name="password" required/>
                        <button class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-primary" type="button">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                </div>
                <button class="mt-2 w-full bg-primary hover:bg-emerald-dark text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 transform transition-all active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
                    <span>Masuk Ke Portal</span>
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </button>
                <div class="text-center mt-2">
                    <a class="text-xs font-medium text-slate-500 hover:text-primary transition-colors" href="#">
                        Lupa password? <span class="text-primary font-bold underline decoration-gold-accent/50 underline-offset-4">Hubungi Panitia IT MTI Canduang</span>
                    </a>
                </div>
            </form>
            <div class="bg-primary/5 dark:bg-primary/10 border-t border-slate-100 dark:border-slate-800 p-6">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-white dark:bg-background-dark rounded-lg shadow-sm">
                        <span class="material-symbols-outlined text-primary text-[20px]">verified_user</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-[11px] leading-tight text-slate-600 dark:text-slate-400 font-medium">
                            WAJIB menggunakan <span class="text-emerald-dark dark:text-emerald-300 font-bold">Exambro MTIC</span> untuk memulai ujian demi keamanan sistem.
                        </p>
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <p class="text-[10px] tracking-wider font-bold text-emerald-600 dark:text-emerald-400 uppercase">
                                Browser Terdeteksi: Exambro
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center gap-2 opacity-60">
        <p class="text-[10px] text-center text-slate-500 dark:text-slate-400 font-light">
            © 2024 IT Development - Pondok Pesantren MTI Canduang<br/>
            Bukittinggi, Sumatera Barat
        </p>
    </div>
    <script src="<?= base_url('js/auth.js') ?>"></script>
</body>
</html>
