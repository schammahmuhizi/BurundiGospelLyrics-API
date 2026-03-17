<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Plus, Edit2, Trash2, Eye, Clock, CheckCircle, AlertCircle, BarChart3, Music } from 'lucide-vue-next';
import { formatDate } from '@/Utils/helpers';

const props = defineProps({
    songs: Array
});

const handleDelete = (id) => {
    if (confirm('Are you sure you want to delete this song?')) {
        router.delete(`/songs/${id}`);
    }
};

const totalViews = props.songs.reduce((acc, s) => acc + s.views, 0).toLocaleString();
const approvedCount = props.songs.filter(s => s.status === 'approved').length;
</script>

<template>
    <AppLayout>
        <Head title="Artist Dashboard" />

        <div class="py-12">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-bold text-xs uppercase tracking-widest mb-4">Management</span>
                    <h1 class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase">ARTIST STUDIO</h1>
                    <p class="text-slate-500 dark:text-slate-400 font-medium mt-2 text-lg">Manage your creative works and track their impact</p>
                </div>
                <Link href="/dashboard/add" class="bg-amber-500 text-white px-8 py-4 rounded-2xl font-black flex items-center gap-3 hover:bg-amber-600 transition-all shadow-xl shadow-amber-500/20 active:scale-95 group">
                    <Plus class="w-6 h-6 group-hover:rotate-90 transition-transform duration-300" />
                    PUBLISH NEW WORK
                </Link>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none group hover:border-amber-500 transition-colors">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-slate-50 dark:bg-slate-800 rounded-2xl text-slate-400 group-hover:bg-slate-900 dark:group-hover:bg-white dark:group-hover:text-slate-900 group-hover:text-white transition-all">
                            <Music class="w-6 h-6" />
                        </div>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Total Songs</p>
                    </div>
                    <p class="text-5xl font-black text-slate-900 dark:text-white leading-none">{{ songs.length }}</p>
                </div>
                
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none group hover:border-amber-500 transition-colors">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-2xl text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all">
                            <Eye class="w-6 h-6" />
                        </div>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Global Views</p>
                    </div>
                    <p class="text-5xl font-black text-slate-900 dark:text-white leading-none">{{ totalViews }}</p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none group hover:border-amber-500 transition-colors">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-2xl text-green-500 group-hover:bg-green-500 group-hover:text-white transition-all">
                            <CheckCircle class="w-6 h-6" />
                        </div>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Approved</p>
                    </div>
                    <p class="text-5xl font-black text-slate-900 dark:text-white leading-none">{{ approvedCount }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-slate-800 shadow-2xl shadow-slate-200/40 dark:shadow-none overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                            <tr>
                                <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.2em]">Creative Work</th>
                                <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.2em]">Status</th>
                                <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.2em]">Views</th>
                                <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.2em]">Published</th>
                                <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.2em] text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            <tr v-for="song in songs" :key="song.id" class="hover:bg-slate-50/30 dark:hover:bg-slate-800/30 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-md group-hover:scale-110 transition-transform duration-500">
                                            <img :src="song.cover_image || `https://picsum.photos/seed/${song.id}/100/100`" class="w-full h-full object-cover" alt="" />
                                        </div>
                                        <span class="text-slate-900 dark:text-white font-black text-lg group-hover:text-amber-600 transition-colors uppercase tracking-tight">{{ song.title }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span v-if="song.status === 'approved'" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-500 rounded-full text-[10px] font-black uppercase tracking-widest">
                                        <CheckCircle class="w-3.5 h-3.5" /> Approved
                                    </span>
                                    <span v-else class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 rounded-full text-[10px] font-black uppercase tracking-widest animate-pulse">
                                        <AlertCircle class="w-3.5 h-3.5" /> Pending
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400 font-bold">
                                        <Eye class="w-4 h-4 text-slate-300 dark:text-slate-600" /> {{ song.views.toLocaleString() }}
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-slate-400 dark:text-slate-500 font-medium text-sm">
                                        <Clock class="w-4 h-4 opacity-50" /> {{ formatDate(song.created_at) }}
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <Link :href="`/dashboard/edit/${song.id}`" class="p-3 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white rounded-2xl transition-all">
                                            <Edit2 class="w-5 h-5" />
                                        </Link>
                                        <button @click="handleDelete(song.id)" class="p-3 text-slate-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-500 rounded-2xl transition-all">
                                            <Trash2 class="w-5 h-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="songs.length === 0" class="py-32 text-center space-y-4">
                    <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <Music class="w-10 h-10 text-slate-200 dark:text-slate-700" />
                    </div>
                    <p class="text-slate-900 dark:text-white text-2xl font-black tracking-tight uppercase">Silent Portfolio</p>
                    <p class="text-slate-500 dark:text-slate-400 font-medium">Start your journey by publishing your first lyrics.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
