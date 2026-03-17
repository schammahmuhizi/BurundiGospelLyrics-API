<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Music, Save, ArrowLeft, Image as ImageIcon, Youtube, Disc, Tag, Calendar } from 'lucide-vue-next';

const props = defineProps({
    song: Object,
    isEdit: Boolean
});

const form = useForm({
    title: props.song?.title || '',
    lyrics: props.song?.lyrics || '',
    album: props.song?.album || '',
    youtube_link: props.song?.youtube_link || '',
    cover_image: props.song?.cover_image || '',
    genre: props.song?.genre || '',
    release_year: props.song?.release_year || new Date().getFullYear()
});

const submit = () => {
    if (props.isEdit) {
        form.put(`/songs/${props.song.id}`);
    } else {
        form.post('/songs');
    }
};

const goBack = () => {
    router.visit('/dashboard');
};
</script>

<template>
    <AppLayout>
        <Head :title="isEdit ? 'Edit Lyrics' : 'Publish New Lyrics'" />

        <div class="py-12 max-w-5xl mx-auto px-4">
            <div class="flex items-center gap-6 mb-12">
                <button @click="goBack" class="p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl text-slate-400 hover:text-slate-900 dark:hover:text-white hover:shadow-lg transition-all active:scale-95 group">
                    <ArrowLeft class="w-6 h-6 group-hover:-translate-x-1 transition-transform" />
                </button>
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-amber-500/10 text-amber-600 font-bold text-xs uppercase tracking-widest mb-2">Content Studio</span>
                    <h1 class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter uppercase">
                        {{ isEdit ? 'EDIT WORK' : 'NEW PUBLICATION' }}
                    </h1>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-12 pb-24">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Basic Info -->
                    <div class="lg:col-span-12 bg-white dark:bg-slate-900 rounded-[3.5rem] p-10 md:p-14 border border-slate-100 dark:border-slate-800 shadow-2xl shadow-slate-200/50 dark:shadow-none space-y-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Composition Title</label>
                                <div class="relative group">
                                    <Music class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 dark:text-slate-600 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.title"
                                        type="text"
                                        required
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 dark:placeholder-slate-600 outline-none"
                                        placeholder="Enter full song title"
                                    />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Album / Compilation</label>
                                <div class="relative group">
                                    <Disc class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 dark:text-slate-600 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.album"
                                        type="text"
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 dark:placeholder-slate-600 outline-none"
                                        placeholder="Album name (optional)"
                                    />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Musical Genre</label>
                                <div class="relative group">
                                    <Tag class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 dark:text-slate-600 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.genre"
                                        type="text"
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 dark:placeholder-slate-600 outline-none"
                                        placeholder="Pop, Hip-Hop, etc."
                                    />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Release Year</label>
                                <div class="relative group">
                                    <Calendar class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 dark:text-slate-600 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.release_year"
                                        type="number"
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all outline-none"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-10 border-t border-slate-50 dark:border-slate-800/50">
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Artwork URL</label>
                                <div class="relative group">
                                    <ImageIcon class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 dark:text-slate-600 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.cover_image"
                                        type="url"
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 dark:placeholder-slate-600 outline-none"
                                        placeholder="https://images.unsplash.com/..."
                                    />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Video Link (YouTube)</label>
                                <div class="relative group">
                                    <Youtube class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 dark:text-slate-600 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.youtube_link"
                                        type="url"
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 dark:placeholder-slate-600 outline-none"
                                        placeholder="https://youtube.com/watch?v=..."
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lyrics Area -->
                    <div class="lg:col-span-12 bg-white dark:bg-slate-900 rounded-[3.5rem] p-10 md:p-14 border border-slate-100 dark:border-slate-800 shadow-2xl shadow-slate-200/50 dark:shadow-none">
                        <div class="flex items-center justify-between mb-8">
                            <label class="block text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Lyric Composition</label>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] bg-slate-50 dark:bg-slate-800 px-4 py-1.5 rounded-full">Primary Manuscript</span>
                        </div>
                        <textarea
                            v-model="form.lyrics"
                            required
                            rows="20"
                            class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-[2.5rem] py-10 px-10 text-slate-900 dark:text-white leading-[1.8] font-sans font-medium focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 dark:placeholder-slate-700 text-xl outline-none"
                            placeholder="Format your lyrics here (Verses, Chorus, Outro)..."
                        ></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-6 pt-10">
                    <button type="button" @click="goBack" class="px-10 py-5 rounded-2xl text-slate-500 font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition-all uppercase tracking-widest">Discard Craft</button>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="bg-amber-500 text-white px-12 py-5 rounded-2xl font-black flex items-center gap-3 hover:bg-amber-600 shadow-2xl shadow-amber-500/30 active:scale-95 disabled:opacity-50 text-xl tracking-tight transition-all"
                    >
                        <Save class="w-6 h-6" />
                        {{ form.processing ? 'PROCESSING...' : (isEdit ? 'UPDATE CHANGES' : 'PUBLISH WORK') }}
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
