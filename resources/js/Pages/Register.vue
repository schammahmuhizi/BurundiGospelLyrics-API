<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { User, Mail, Lock, Music, ArrowRight, ShieldCheck, Sparkles } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Become an Artist - LyricsHub" />

        <div class="min-h-[90vh] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute -top-20 -right-20 -z-10 w-[50rem] h-[50rem] bg-amber-500/5 dark:bg-amber-900/10 blur-[150px] rounded-full"></div>
            <div class="absolute -bottom-20 -left-20 -z-10 w-[40rem] h-[40rem] bg-blue-500/5 dark:bg-blue-900/10 blur-[150px] rounded-full"></div>

            <div class="max-w-xl w-full space-y-12">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <Sparkles class="w-4 h-4 text-amber-500" />
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Artist Onboarding</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tighter uppercase leading-none">JOIN THE HUB</h1>
                    <p class="text-xl text-slate-500 dark:text-slate-400 font-medium">Start publishing your legacy today.</p>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-[3rem] p-10 md:p-14 border border-slate-100 dark:border-slate-800 shadow-2xl shadow-slate-200/50 dark:shadow-none space-y-10">
                    <form @submit.prevent="submit" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Name -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Artist Name</label>
                                <div class="relative group">
                                    <User class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-4 text-slate-300 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        required
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 outline-none"
                                        placeholder="Stage name"
                                    />
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Key</label>
                                <div class="relative group">
                                    <Mail class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-4 text-slate-300 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        required
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 outline-none"
                                        placeholder="Email address"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Password -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Secret Key</label>
                                <div class="relative group">
                                    <Lock class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-4 text-slate-300 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.password"
                                        type="password"
                                        required
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 outline-none"
                                        placeholder="••••••••"
                                    />
                                </div>
                            </div>

                            <!-- Confirmation -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Verify Secret</label>
                                <div class="relative group">
                                    <ShieldCheck class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-4 text-slate-300 group-focus-within:text-amber-500 transition-colors" />
                                    <input
                                        v-model="form.password_confirmation"
                                        type="password"
                                        required
                                        class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 outline-none"
                                        placeholder="Repeat secret"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="px-1">
                            <label class="flex items-start gap-3 cursor-pointer group">
                                <input type="checkbox" v-model="form.terms" required class="mt-1 w-6 h-6 rounded-lg border-slate-200 dark:border-slate-700 text-amber-500 focus:ring-amber-500/20 bg-slate-50 dark:bg-slate-800 transition-all" />
                                <span class="text-sm font-bold text-slate-500 dark:text-slate-400 leading-relaxed group-hover:text-amber-500 transition-colors">
                                    I agree to the <span class="text-slate-900 dark:text-white underline underline-offset-4">Terms of Artistry</span> and acknowledge the global publishing policy of LyricsHub.
                                </span>
                            </label>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-slate-900 dark:bg-amber-500 text-white dark:text-slate-900 py-6 rounded-2xl font-black text-2xl shadow-2xl shadow-slate-900/20 dark:shadow-amber-500/20 flex items-center justify-center gap-4 hover:scale-[1.02] active:scale-95 transition-all disabled:opacity-50"
                        >
                            {{ form.processing ? 'REGISTERING...' : 'START YOUR LEGACY' }}
                            <Music v-if="!form.processing" class="w-6 h-6" />
                        </button>
                    </form>
                </div>

                <p class="text-center text-slate-500 dark:text-slate-500 font-bold">
                    Already an artist? 
                    <Link href="/login" class="text-amber-500 font-black hover:underline underline-offset-4 ml-1 uppercase">Sign In Directly</Link>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
