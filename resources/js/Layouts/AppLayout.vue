<script setup>
import Navbar from "../Components/Navbar.vue";
</script>

<template>
    <div
        class="min-h-screen bg-slate-50 dark:bg-slate-950 font-sans selection:bg-amber-200 dark:selection:bg-amber-500/30 selection:text-amber-900 dark:selection:text-amber-200 transition-colors duration-500"
    >
        <Navbar />

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <slot />
        </main>

        <!-- Premium Footer -->
        <footer
            class="bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 py-20 mt-20 relative overflow-hidden transition-colors"
        >
            <div
                class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-amber-500 to-transparent opacity-20"
            ></div>

            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12"
            >
                <div class="space-y-6">
                    <span
                        class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter"
                        >LYRICSHUB</span
                    >
                    <p
                        class="text-slate-500 dark:text-slate-400 font-medium leading-relaxed"
                    >
                        Connecting artists and fans through the power of every
                        word. The definitive source for song meanings.
                    </p>
                </div>

                <div>
                    <h4
                        class="text-slate-900 dark:text-white font-black uppercase tracking-widest text-sm mb-6"
                    >
                        Explore
                    </h4>
                    <ul
                        class="space-y-3 text-slate-500 dark:text-slate-400 font-bold"
                    >
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            Top Charts
                        </li>
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            New Lyrics
                        </li>
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            Featured Artists
                        </li>
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            Glossary
                        </li>
                    </ul>
                </div>

                <div>
                    <h4
                        class="text-slate-900 dark:text-white font-black uppercase tracking-widest text-sm mb-6"
                    >
                        Company
                    </h4>
                    <ul
                        class="space-y-3 text-slate-500 dark:text-slate-400 font-bold"
                    >
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            About Us
                        </li>
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            Careers
                        </li>
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            Partners
                        </li>
                        <li
                            class="hover:text-amber-500 transition-colors cursor-pointer"
                        >
                            Legals
                        </li>
                    </ul>
                </div>

                <div>
                    <h4
                        class="text-slate-900 dark:text-white font-black uppercase tracking-widest text-sm mb-6"
                    >
                        Join Us
                    </h4>
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all cursor-pointer"
                        >
                            <span class="font-black text-xl">𝕏</span>
                        </div>
                        <div
                            class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all cursor-pointer"
                        >
                            <span class="font-black text-xl">IG</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 pt-8 border-t border-slate-50 dark:border-slate-800/50 flex flex-col md:flex-row justify-between items-center gap-4"
            >
                <p
                    class="text-slate-400 dark:text-slate-500 text-sm font-bold uppercase tracking-widest"
                >
                    &copy; 2026 LYRICSHUB MEDIA. ALL RIGHTS RESERVED.
                </p>
                <div
                    class="flex gap-8 text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest"
                >
                    <span
                        class="hover:text-slate-900 dark:hover:text-white cursor-pointer transition-colors"
                        >Privacy</span
                    >
                    <span
                        class="hover:text-slate-900 dark:hover:text-white cursor-pointer transition-colors"
                        >Terms</span
                    >
                </div>
            </div>
        </footer>
    </div>
</template>
