<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Youtube, Share2, Play, Eye, Calendar, User, Music, ChevronRight } from 'lucide-vue-next';
import { getYouTubeId, formatDate } from '@/Utils/helpers';

const props = defineProps({
    song: Object
});

const youtubeId = getYouTubeId(props.song.youtube_link);
</script>

<template>
    <AppLayout>
        <Head :title="`${song.title} - ${song.artist?.name || song.artist_name} Lyrics`" />

        <div class="relative min-h-screen">
            <!-- Background Decorative Elements -->
            <div class="absolute top-0 right-0 -z-10 w-[40rem] h-[40rem] bg-amber-500/10 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="py-12 space-y-12">
                <!-- Breadcrumbs -->
                <div class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">
                    <Link href="/" class="hover:text-amber-500 transition-colors">Home</Link>
                    <ChevronRight class="w-3 h-3" />
                    <Link :href="`/search?q=${song.genre}`" v-if="song.genre" class="hover:text-amber-500 transition-colors">{{ song.genre }}</Link>
                    <ChevronRight v-if="song.genre" class="w-3 h-3" />
                    <span class="text-slate-900 dark:text-white">{{ song.title }}</span>
                </div>

                <!-- Header Section -->
                <div class="flex flex-col md:flex-row gap-12 items-start">
                    <div class="w-full md:w-80 aspect-square rounded-[3rem] overflow-hidden shadow-2xl shadow-slate-200/50 dark:shadow-none border-4 border-white dark:border-slate-800">
                        <img :src="song.cover_image || `https://picsum.photos/seed/${song.id}/500/500`" class="w-full h-full object-cover" alt="">
                    </div>
                    
                    <div class="flex-1 space-y-6">
                        <div class="space-y-2">
                             <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tighter uppercase leading-none">
                                {{ song.title }}
                             </h1>
                             <Link :href="`/artist/${song.artist_id}`" class="flex items-center gap-3 group">
                                <div class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center group-hover:bg-amber-500 transition-all">
                                    <User class="w-5 h-5 text-slate-400 group-hover:text-white" />
                                </div>
                                <span class="text-2xl font-bold text-slate-500 dark:text-slate-400 group-hover:text-amber-500 transition-colors">
                                    {{ song.artist?.name || song.artist_name }}
                                </span>
                             </Link>
                        </div>

                        <div class="flex flex-wrap gap-4 pt-4">
                            <div class="px-6 py-3 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-center gap-3">
                                <Eye class="w-5 h-5 text-amber-500" />
                                <span class="font-black text-slate-900 dark:text-white uppercase text-sm tracking-widest">{{ song.views?.toLocaleString() || 0 }} Views</span>
                            </div>
                            <div class="px-6 py-3 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-center gap-3">
                                <Calendar class="w-5 h-5 text-amber-500" />
                                <span class="font-black text-slate-900 dark:text-white uppercase text-sm tracking-widest">{{ song.release_year || formatDate(song.created_at) }}</span>
                            </div>
                            <button class="px-6 py-3 bg-amber-500 text-white rounded-2xl font-black shadow-lg shadow-amber-500/20 flex items-center gap-3 hover:scale-105 active:scale-95 transition-all">
                                <Share2 class="w-5 h-5" />
                                SHARE
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Lyrics Column -->
                    <div class="lg:col-span-7 space-y-8">
                        <div class="bg-white dark:bg-slate-900 rounded-[3rem] p-10 md:p-14 border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/40 dark:shadow-none">
                            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tight mb-10 pb-6 border-b border-slate-50 dark:border-slate-800">
                                LYRICS <span class="text-amber-500">TRANSCRIPT</span>
                            </h2>
                            <pre class="whitespace-pre-wrap font-sans text-xl md:text-2xl text-slate-700 dark:text-slate-300 leading-[1.8] tracking-tight font-medium">
                                {{ song.lyrics }}
                            </pre>
                        </div>
                    </div>

                    <!-- Media & Info Column -->
                    <div class="lg:col-span-5 space-y-8">
                        <!-- Video Section -->
                        <div v-if="youtubeId" class="bg-slate-900 rounded-[3rem] overflow-hidden shadow-2xl">
                             <div class="px-8 py-6 border-b border-white/5 flex items-center justify-between">
                                <div class="flex items-center gap-3 text-white">
                                    <Youtube class="w-6 h-6 text-red-500" />
                                    <span class="font-black uppercase tracking-tight">Official Video</span>
                                </div>
                                <div class="w-2.5 h-2.5 bg-red-500 rounded-full animate-pulse"></div>
                             </div>
                             <div class="aspect-video">
                                <iframe 
                                    class="w-full h-full" 
                                    :src="`https://www.youtube.com/embed/${youtubeId}`" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                ></iframe>
                             </div>
                        </div>

                        <!-- Info Card -->
                        <div class="bg-amber-500 rounded-[3rem] p-10 text-white shadow-xl shadow-amber-500/30">
                            <Music class="w-12 h-12 mb-6" />
                            <h3 class="text-3xl font-black uppercase tracking-tighter leading-none mb-4">About this Creative Work</h3>
                            <p class="font-bold text-amber-100 leading-relaxed mb-8">
                                Published via LyricsHub Artist Studio. All rights reserved by the respective artist. Meanings are community sourced.
                            </p>
                            <Link v-if="song.album" :href="`/search?q=${song.album}`" class="inline-flex px-6 py-3 bg-white/20 hover:bg-white/30 rounded-2xl font-black transition-all">
                                VIEW ALBUM: {{ song.album.toUpperCase() }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
