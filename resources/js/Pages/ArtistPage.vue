<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import SongCard from '@/Components/SongCard.vue';
import { BadgeCheck, Share2, Users, Music, Star, Info } from 'lucide-vue-next';

defineProps({
    artist: Object
});
</script>

<template>
    <AppLayout>
        <Head :title="`${artist.name} - Artist Profile`" />

        <div class="space-y-16 pb-24">
            <!-- Artist Hero -->
            <section class="relative bg-slate-900 dark:bg-slate-900 rounded-[4rem] p-10 md:p-20 overflow-hidden shadow-2xl">
                <!-- Background Glow -->
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[40rem] h-[40rem] bg-amber-500/20 blur-[120px] rounded-full"></div>
                
                <div class="relative flex flex-col md:flex-row items-center gap-12 z-10">
                    <div class="w-48 h-48 md:w-64 md:h-64 rounded-full overflow-hidden border-8 border-white/10 shadow-2xl flex-shrink-0">
                        <img :src="artist.profile_image || `https://picsum.photos/seed/${artist.id}/400/400`" class="w-full h-full object-cover" alt="">
                    </div>
                    
                    <div class="flex-1 text-center md:text-left space-y-6">
                        <div class="flex flex-col items-center md:items-start gap-4">
                            <div class="flex items-center gap-2 px-4 py-1.5 bg-amber-500 rounded-full text-[10px] font-black uppercase text-slate-900 tracking-widest shadow-lg shadow-amber-500/20">
                                <BadgeCheck class="w-3.5 h-3.5" />
                                Verified Artist
                            </div>
                            <h1 class="text-5xl md:text-8xl font-black text-white tracking-tighter leading-none uppercase">{{ artist.name }}</h1>
                        </div>

                        <!-- Stats Bar -->
                        <div class="flex flex-wrap justify-center md:justify-start gap-8">
                            <div class="flex flex-col">
                                <span class="text-amber-500 font-black text-3xl">#1</span>
                                <span class="text-white/40 text-xs font-black uppercase tracking-widest">Global Rank</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-white font-black text-3xl">{{ artist.songs?.length || 0 }}</span>
                                <span class="text-white/40 text-xs font-black uppercase tracking-widest">Songs</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-white font-black text-3xl">8.2M</span>
                                <span class="text-white/40 text-xs font-black uppercase tracking-widest">Monthly Readers</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 w-full md:w-auto">
                        <button class="px-10 py-5 bg-white text-slate-900 rounded-[2rem] font-black flex items-center justify-center gap-3 hover:scale-105 transition-all shadow-xl">
                            <Star class="w-6 h-6 fill-amber-500 text-amber-500" />
                            FOLLOW
                        </button>
                        <button class="px-10 py-5 bg-white/10 text-white rounded-[2rem] font-black flex items-center justify-center gap-3 hover:bg-white/20 transition-all border border-white/5">
                            <Share2 class="w-6 h-6" />
                            SHARE PROFILE
                        </button>
                    </div>
                </div>
            </section>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Discography -->
                <div class="lg:col-span-8 space-y-12">
                    <div class="flex items-center justify-between">
                         <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Discography</h2>
                         <div class="h-1 flex-grow mx-8 bg-slate-100 dark:bg-slate-800 rounded-full"></div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                        <SongCard v-for="song in artist.songs" :key="song.id" :song="song" />
                    </div>

                    <div v-if="!artist.songs?.length" class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-16 rounded-[3rem] text-center space-y-4">
                        <Music class="w-12 h-12 text-slate-200 dark:text-slate-800 mx-auto" />
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">No songs published yet</p>
                    </div>
                </div>

                <!-- Info Sidebar -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-[3rem] p-10 border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none space-y-8">
                        <div>
                            <h3 class="flex items-center gap-3 text-slate-900 dark:text-white font-black uppercase text-sm tracking-[0.2em] mb-4">
                                <Info class="w-5 h-5 text-amber-500" />
                                Biography
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 font-medium leading-relaxed italic">
                                "{{ artist.bio || 'This artist has not provided a biography yet.' }}"
                            </p>
                        </div>

                        <div class="pt-8 border-t border-slate-50 dark:border-slate-800 space-y-6">
                            <h3 class="flex items-center gap-3 text-slate-900 dark:text-white font-black uppercase text-sm tracking-[0.2em]">
                                <Users class="w-5 h-5 text-amber-500" />
                                Social Presence
                            </h3>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 bg-slate-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all cursor-pointer">
                                    <span class="font-black text-xl">𝕏</span>
                                </div>
                                <div class="w-12 h-12 bg-slate-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all cursor-pointer">
                                    <span class="font-black text-xl">IG</span>
                                </div>
                                <div class="w-12 h-12 bg-slate-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all cursor-pointer">
                                    <span class="font-black text-xl">YT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
