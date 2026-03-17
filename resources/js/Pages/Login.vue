<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Mail, Lock, ArrowRight, ShieldCheck, Github } from "lucide-vue-next";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post("/login", {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Sign In - LyricsHub" />

        <div
            class="min-h-[80vh] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden"
        >
            <!-- Decorative Background -->
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -z-10 w-[60rem] h-[60rem] bg-amber-500/5 dark:bg-amber-900/10 blur-[150px] rounded-full"
            ></div>

            <div class="max-w-md w-full space-y-12">
                <div class="text-center space-y-4">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm animate-bounce"
                    >
                        <ShieldCheck class="w-4 h-4 text-amber-500" />
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500"
                            >Secure Access</span
                        >
                    </div>
                    <h1
                        class="text-5xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tighter uppercase leading-none"
                    >
                        SIGN IN
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 font-medium">
                        Welcome back to the global home of lyrics.
                    </p>
                </div>

                <div
                    class="bg-white dark:bg-slate-900 rounded-[3rem] p-10 md:p-12 border border-slate-100 dark:border-slate-800 shadow-2xl shadow-slate-200/50 dark:shadow-none space-y-8"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-2">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1"
                                >Identity Key (Email)</label
                            >
                            <div class="relative group">
                                <Mail
                                    class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-4 text-slate-300 group-focus-within:text-amber-500 transition-colors"
                                />
                                <input
                                    v-model="form.email"
                                    type="email"
                                    required
                                    class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 outline-none"
                                    placeholder="Enter your email"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1"
                                >Secret Key (Password)</label
                            >
                            <div class="relative group">
                                <Lock
                                    class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-4 text-slate-300 group-focus-within:text-amber-500 transition-colors"
                                />
                                <input
                                    v-model="form.password"
                                    type="password"
                                    required
                                    class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-4 pl-12 pr-4 text-slate-900 dark:text-white font-bold focus:ring-4 focus:ring-amber-500/10 transition-all placeholder-slate-300 outline-none"
                                    placeholder="••••••••"
                                />
                            </div>
                        </div>

                        <div class="flex items-center justify-between px-1">
                            <label
                                class="flex items-center gap-2 cursor-pointer group"
                            >
                                <input
                                    type="checkbox"
                                    v-model="form.remember"
                                    class="w-5 h-5 rounded-lg border-slate-200 dark:border-slate-700 text-amber-500 focus:ring-amber-500/20 bg-slate-50 dark:bg-slate-800 transition-all"
                                />
                                <span
                                    class="text-sm font-bold text-slate-400 dark:text-slate-500 group-hover:text-amber-500 transition-colors"
                                    >Remember identity</span
                                >
                            </label>
                            <Link
                                href="/forgot-password"
                                class="text-sm font-black text-slate-400 dark:text-slate-500 hover:text-amber-500 transition-colors"
                                >Lost password?</Link
                            >
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-slate-900 dark:bg-amber-500 text-white dark:text-slate-900 py-5 rounded-2xl font-black text-xl shadow-xl shadow-slate-900/20 dark:shadow-amber-500/20 flex items-center justify-center gap-3 hover:scale-[1.02] active:scale-95 transition-all disabled:opacity-50"
                        >
                            {{ form.processing ? "SIGNING IN..." : "CONTINUE" }}
                            <ArrowRight
                                v-if="!form.processing"
                                class="w-6 h-6"
                            />
                        </button>
                    </form>

                    <div class="relative py-4 flex items-center gap-4">
                        <div
                            class="h-px flex-1 bg-slate-100 dark:bg-slate-800"
                        ></div>
                        <!-- <span
                            class="text-[10px] font-black text-slate-300 dark:text-slate-600 uppercase tracking-[0.3em]"
                            >Global Connect</span> -->

                        <div
                            class="h-px flex-1 bg-slate-100 dark:bg-slate-800"
                        ></div>
                    </div>

                    <!-- <button class="w-full bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 px-6 py-4 rounded-2xl flex items-center justify-center gap-3 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all group shadow-sm">
                        <Github class="w-5 h-5 text-slate-900 dark:text-white" />
                        <span class="font-bold text-slate-600 dark:text-slate-300">Sign in with GitHub</span>
                    </button> -->
                </div>

                <p
                    class="text-center text-slate-500 dark:text-slate-500 font-bold"
                >
                    First time here?
                    <Link
                        href="/register"
                        class="text-amber-500 font-black hover:underline underline-offset-4 ml-1"
                        >CREATE ACCOUNT</Link
                    >
                </p>
            </div>
        </div>
    </AppLayout>
</template>
