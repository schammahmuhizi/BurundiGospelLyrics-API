<script setup>
import { Link } from '@inertiajs/vue3';
import { Eye, TrendingUp, Music } from 'lucide-vue-next';

defineProps({
    song: Object,
    rank: Number
});
</script>

<template>
    <Link :href="`/lyrics/${song.id}`" class="group relative flex flex-col bg-white dark:bg-slate-800 rounded-[2.5rem] p-4 border border-slate-100 dark:border-slate-700 shadow-xl shadow-slate-200/50 dark:shadow-none hover:shadow-2xl hover:shadow-amber-500/20 dark:hover:shadow-amber-500/10 hover:border-amber-500 transition-all duration-500 active:scale-95">
        <!-- Rank Badge -->
        <div v-if="rank" class="absolute -top-3 -left-3 w-12 h-12 bg-slate-900 dark:bg-amber-500 text-white dark:text-slate-900 rounded-2xl flex items-center justify-center font-black text-xl shadow-lg group-hover:scale-110 transition-transform z-10">
            #{{ rank }}
        </div>

        <!-- Cover Image -->
        <div class="relative aspect-square rounded-[2rem] overflow-hidden mb-6 shadow-md">
            <img 
                :src="song.cover_image || `https://picsum.photos/seed/${song.id}/400/400`" 
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                alt=""
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-6">
                <div class="w-14 h-14 bg-amber-500 rounded-full flex items-center justify-center text-white shadow-xl scale-75 group-hover:scale-100 transition-transform duration-500">
                    <Music class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="px-2 pb-2 space-y-1">
            <h3 class="text-xl font-black text-slate-900 dark:text-white truncate uppercase tracking-tight group-hover:text-amber-500 transition-colors">
                {{ song.title }}
            </h3>
            <p class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest flex items-center gap-2">
                {{ song.artist?.name || song.artist_name || 'Various Artists' }}
            </p>
        </div>

        <!-- Stats Bar -->
        <div class="mt-4 pt-4 border-t border-slate-50 dark:border-slate-700 flex items-center justify-between px-2">
            <div class="flex items-center gap-1.5 text-slate-400 dark:text-slate-500">
                <Eye class="w-4 h-4" />
                <span class="text-xs font-black">{{ song.views?.toLocaleString() || 0 }}</span>
            </div>
            <div v-if="song.views > 1000" class="px-3 py-1 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 rounded-full text-[10px] font-black uppercase tracking-widest">
                Rising
            </div>
        </div>
    </Link>
</template>
