<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Shield, Users, Music, CheckCircle, Trash2, Eye, BarChart3, AlertCircle } from 'lucide-vue-next';
import { formatDate } from '@/Utils/helpers';

const props = defineProps({
    stats: Object,
    pendingSongs: Array,
    users: Array
});

const handleApprove = (id) => {
    router.put(`/songs/${id}`, { status: 'approved' });
};

const handleDelete = (id) => {
    if (confirm('Are you sure you want to delete this content?')) {
        router.delete(`/songs/${id}`);
    }
};
</script>

<template>
    <AppLayout>
        <Head title="Admin Control Panel" />

        <div class="py-12 space-y-16">
            <div class="flex items-center gap-6">
                <div class="p-5 bg-amber-500 rounded-[1.5rem] text-white shadow-2xl shadow-amber-500/30">
                    <Shield class="w-10 h-10" />
                </div>
                <div>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white uppercase tracking-tighter leading-none">GOVERNANCE</h1>
                    <p class="text-slate-500 dark:text-slate-400 font-medium mt-2 text-lg">Platform oversight and systemic operations</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[3rem] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none">
                    <div class="flex items-center gap-3 text-amber-500 mb-8 font-black text-xs uppercase tracking-[0.2em]">
                        <Music class="w-5 h-5" />
                        Platform Content
                    </div>
                    <p class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">{{ stats?.totalSongs || 0 }}</p>
                </div>
                
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[3rem] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none">
                    <div class="flex items-center gap-3 text-rose-500 mb-8 font-black text-xs uppercase tracking-[0.2em]">
                        <AlertCircle class="w-5 h-5" />
                        Curation Queue
                    </div>
                    <p class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">{{ stats?.pendingSongs || 0 }}</p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-8 rounded-[3rem] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none">
                    <div class="flex items-center gap-3 text-sky-500 mb-8 font-black text-xs uppercase tracking-[0.2em]">
                        <Users class="w-5 h-5" />
                        Registered Artists
                    </div>
                    <p class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">{{ stats?.totalArtists || 0 }}</p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-8 rounded-[3rem] border border-slate-100 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none">
                    <div class="flex items-center gap-3 text-green-500 mb-8 font-black text-xs uppercase tracking-[0.2em]">
                        <BarChart3 class="w-5 h-5" />
                        Global Audience
                    </div>
                    <p class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">{{ stats?.totalViews?.toLocaleString() || 0 }}</p>
                </div>
            </div>

            <!-- Pending Approval Section -->
            <section class="space-y-8">
                <div class="flex items-center gap-6 px-4">
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Curation Registry</h2>
                    <div class="h-px flex-grow bg-slate-100 dark:bg-slate-800"></div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-[3.5rem] border border-slate-100 dark:border-slate-800 shadow-2xl shadow-slate-200/40 dark:shadow-none overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                <tr>
                                    <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.3em]">Manuscript Title</th>
                                    <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.3em]">Artist Profile</th>
                                    <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.3em] text-right">Administrative</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                <tr v-for="song in pendingSongs" :key="song.id" class="hover:bg-amber-50/10 dark:hover:bg-amber-900/5 transition-all group">
                                    <td class="px-8 py-6">
                                        <span class="text-slate-900 dark:text-white font-black text-lg group-hover:text-amber-600 transition-colors uppercase tracking-tight">{{ song.title }}</span>
                                    </td>
                                    <td class="px-8 py-6 text-slate-500 dark:text-slate-400 font-bold uppercase text-[10px] tracking-widest">{{ song.artist_name || song.artist?.name }}</td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-4">
                                            <button @click="handleApprove(song.id)" class="px-8 py-2.5 bg-slate-900 dark:bg-amber-500 text-white dark:text-slate-900 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg hover:scale-105 active:scale-95 transition-all">Approve Entry</button>
                                            <button @click="handleDelete(song.id)" class="px-8 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-rose-50 dark:hover:bg-rose-900/20 hover:text-rose-600 transition-all active:scale-95">Reject</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- User Management Section -->
            <section class="space-y-8">
                <div class="flex items-center gap-6 px-4">
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Identity Registry</h2>
                    <div class="h-px flex-grow bg-slate-100 dark:bg-slate-800"></div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-[3.5rem] border border-slate-100 dark:border-slate-800 shadow-2xl shadow-slate-200/40 dark:shadow-none overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                <tr>
                                    <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.3em]">Verified Identity</th>
                                    <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.3em]">Access Key</th>
                                    <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.3em]">Tier</th>
                                    <th class="px-8 py-6 text-slate-400 font-black uppercase text-xs tracking-[0.3em]">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                <tr v-for="user in users" :key="user.id" class="hover:bg-slate-50/30 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-8 py-6 text-slate-900 dark:text-white font-black text-lg">{{ user.name }}</td>
                                    <td class="px-8 py-6 text-slate-500 dark:text-slate-400 font-medium font-mono text-sm leading-none">{{ user.email }}</td>
                                    <td class="px-8 py-6">
                                        <span class="inline-block px-4 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-[0.2em] shadow-sm transition-all" :class="user.role === 'admin' ? 'bg-amber-500 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400'">
                                            {{ user.role }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-slate-400 dark:text-slate-500 font-bold text-xs uppercase tracking-widest">{{ formatDate(user.created_at) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
