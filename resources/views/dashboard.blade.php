<x-layouts.app :title="__('Dashboard')">
    @php
        $user = auth()->user();
        $isAdmin = $user->id == 1;
        
        // Simple counts
        $totalShops = $isAdmin ? 
            App\Models\ShopResearchForm::count() : 
            App\Models\ShopResearchForm::where('user_id', $user->id)->count();
            
        $totalCustomers = $isAdmin ? 
            App\Models\Customer::count() : 
            App\Models\Customer::where('user_id', $user->id)->count();
            
        $ecommerceShops = $isAdmin ? 
            App\Models\ShopResearchForm::where('enrolled_in_ecommerce', true)->count() : 
            App\Models\ShopResearchForm::where('user_id', $user->id)->where('enrolled_in_ecommerce', true)->count();
    @endphp

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Total Shops -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="flex flex-col h-full justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalShops }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Shops</div>
                    </div>
                    <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                        <i class="fas fa-store mr-2"></i>
                        {{ $ecommerceShops }} e-commerce enabled
                    </div>
                </div>
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>

            <!-- Total Customers -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="flex flex-col h-full justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCustomers }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Total Customers</div>
                    </div>
                    <div class="flex items-center text-sm text-blue-600 dark:text-blue-400">
                        <i class="fas fa-users mr-2"></i>
                        Customer research data
                    </div>
                </div>
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>

            <!-- Quick Actions -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
                <div class="flex flex-col h-full justify-between">
                    <div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</div>
                        <div class="space-y-2">
                            <a href="{{ route('form.index') }}" class="block text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                <i class="fas fa-plus mr-2"></i>New Shop Form
                            </a>
                            <a href="{{ route('customers.index') }}" class="block text-sm text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300">
                                <i class="fas fa-user-plus mr-2"></i>New Customer Form
                            </a>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $isAdmin ? 'Admin View' : 'User View' }}
                    </div>
                </div>
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h3>
                <div class="flex space-x-2">
                    <a href="{{ route('form.record') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                        Shop Records
                    </a>
                    <a href="{{ route('customers.records') }}" class="text-sm text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300">
                        Customer Records
                    </a>
                </div>
            </div>
            <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                <i class="fas fa-chart-line text-4xl mb-2"></i>
                <p>Activity overview coming soon</p>
            </div>
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
