<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Music, Search, LogOut, User, ChevronDown, Sun, Moon, LayoutDashboard, ShieldCheck } from 'lucide-vue-next';

const isDark = ref(false);

onMounted(() => {
    isDark.value = document.documentElement.classList.contains('dark');
});

const toggleTheme = () => {
    isDark.value = !isDark.value;
    if (isDark.value) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
};

const page = usePage();
const user = page.props.auth.user;

const search = ref('');

const handleSearch = () => {
    if (search.value.trim()) {
        router.get('/search', { q: search.value });
    }
};

const logout = () => {
    router.post('/logout');
};
</script>

<template>
    <nav class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <Link href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform">
                        <Music class="w-6 h-6 text-white" />
                    </div>
                    <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">LYRICSHUB</span>
                </Link>

                <!-- Search -->
                <div class="hidden md:flex flex-1 max-w-md mx-8">
                    <div class="relative w-full group">
                        <Search class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-amber-500 transition-colors" />
                        <input 
                            v-model="search"
                            @keyup.enter="handleSearch"
                            type="text" 
                            placeholder="Explore lyrics, artists..." 
                            class="w-full bg-slate-100 dark:bg-slate-800 border-none rounded-2xl py-2.5 pl-11 pr-4 text-sm font-medium focus:ring-2 focus:ring-amber-500/20 dark:text-white transition-all outline-none"
                        />
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4">
                    <!-- Theme Toggle -->
                    <button @click="toggleTheme" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                        <Sun v-if="isDark" class="w-5 h-5" />
                        <Moon v-else class="w-5 h-5" />
                    </button>

                    <div v-if="user" class="flex items-center gap-2">
                        <Link :href="user.role === 'admin' ? '/dashboard' : '/dashboard'" class="hidden sm:flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all font-bold text-sm">
                            <ShieldCheck v-if="user.role === 'admin'" class="w-4 h-4 text-amber-500" />
                            <LayoutDashboard v-else class="w-4 h-4 text-amber-500" />
                            {{ user.role === 'admin' ? 'Admin' : 'Dashboard' }}
                        </Link>
                        
                        <button @click="logout" class="p-2.5 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                            <LogOut class="w-5 h-5" />
                        </button>
                    </div>
                    
                    <div v-else class="flex items-center gap-3">
                        <Link href="/login" class="px-4 py-2 text-sm font-bold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">Sign In</Link>
                        <Link href="/register" class="px-6 py-2.5 bg-slate-900 dark:bg-amber-500 text-white dark:text-slate-900 rounded-xl text-sm font-bold hover:bg-slate-800 dark:hover:bg-amber-600 transition-all shadow-lg shadow-slate-900/10 dark:shadow-amber-500/10 active:scale-95">Join Artist</Link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
