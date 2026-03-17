<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import SongCard from '@/Components/SongCard.vue';
import { Play, TrendingUp, Clock, Users, ArrowRight } from 'lucide-vue-next';

defineProps({
    trending: Array,
    recent: Array,
    artists: Array
});
</script>

<template>
    <AppLayout>
        <Head title="LyricsHub - Home of Global Lyrics" />

        <div class="space-y-24 pb-24">
            <!-- Hero Section -->
            <section class="relative pt-12">
                <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-amber-100/50 via-transparent to-transparent dark:from-amber-900/20"></div>
                
                <div class="flex flex-col items-center text-center space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800 text-amber-600 dark:text-amber-500 text-xs font-black uppercase tracking-widest animate-fade-in">
                        <TrendingUp class="w-3.5 h-3.5" />
                        The #1 Global Lyrics Platform
                    </div>
                    
                    <h1 class="text-6xl md:text-8xl font-black text-slate-900 dark:text-white tracking-tighter leading-tight max-w-4xl">
                        EVERY WORD <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-600">TELLS A STORY</span>
                    </h1>
                    
                    <p class="text-xl text-slate-500 dark:text-slate-400 font-medium max-w-2xl leading-relaxed">
                        Discover the deepest meanings behind your favorite tracks. Join thousands of artists and fans in the global home for lyrics.
                    </p>
                    
                    <div class="flex flex-wrap items-center justify-center gap-6 pt-4">
                        <Link href="/register" class="px-10 py-5 bg-slate-900 dark:bg-amber-500 text-white dark:text-slate-900 rounded-[2rem] text-xl font-black shadow-2xl shadow-slate-900/20 dark:shadow-amber-500/20 hover:scale-105 transition-all">
                            BECOME AN ARTIST
                        </Link>
                        <a href="#trending" class="px-10 py-5 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-900 dark:text-white rounded-[2rem] text-xl font-bold shadow-xl shadow-slate-200/50 dark:shadow-none hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                            EXPLORE TRENDING
                        </a>
                    </div>
                </div>
            </section>

            <!-- Trending Section -->
            <section id="trending" class="space-y-12">
                <div class="flex items-end justify-between px-4">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 text-amber-500">
                            <TrendingUp class="w-6 h-6" />
                            <span class="text-sm font-black uppercase tracking-widest">Charts</span>
                        </div>
                        <h2 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-none uppercase">GLOBAL TRENDING</h2>
                    </div>
                    <Link href="/search" class="group flex items-center gap-2 text-slate-400 hover:text-amber-500 font-bold transition-colors">
                        VIEW FULL CHART
                        <ArrowRight class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <SongCard v-for="(song, index) in trending" :key="song.id" :song="song" :rank="index + 1" />
                </div>
            </section>

            <!-- Recent Section -->
            <section class="space-y-12">
                <div class="flex items-end justify-between px-4">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 text-slate-400">
                            <Clock class="w-6 h-6" />
                            <span class="text-sm font-black uppercase tracking-widest">New Arrivals</span>
                        </div>
                        <h2 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-none uppercase">JUST PUBLISHED</h2>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    <SongCard v-for="song in recent" :key="song.id" :song="song" />
                </div>
            </section>

            <!-- Featured Artists -->
            <section class="bg-slate-900 dark:bg-slate-800/50 rounded-[4rem] p-12 md:p-20 relative overflow-hidden">
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[30rem] h-[30rem] bg-amber-500/10 blur-[100px] rounded-full"></div>
                
                <div class="relative flex flex-col items-center space-y-16">
                    <div class="text-center space-y-4">
                        <div class="flex items-center justify-center gap-3 text-amber-500">
                            <Users class="w-6 h-6" />
                            <span class="text-sm font-black uppercase tracking-widest">Creators</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight uppercase">FEATURED ARTISTS</h2>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 w-full">
                        <Link v-for="artist in artists" :key="artist.id" :href="`/artist/${artist.id}`" class="group flex flex-col items-center space-y-4">
                            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-white/10 group-hover:border-amber-500 transition-all shadow-2xl">
                                <img :src="artist.profile_image || `https://picsum.photos/seed/${artist.id}/200/200`" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="">
                            </div>
                            <span class="text-xl font-black text-white group-hover:text-amber-500 transition-colors uppercase tracking-tight">{{ artist.name }}</span>
                        </Link>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
