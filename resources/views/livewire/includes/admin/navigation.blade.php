<nav class="flex items-center gap-6 text-sm font-medium w-full">
    <a href="{{ route('admin.dashboard.live') }}" class="text-gray-700 hover:text-indigo-600">
        Livewire Dashboard</a>

    <!-- Categories Dropdown -->
    <div class="relative group">
        <button class="text-gray-700 hover:text-indigo-600 focus:outline-none">
           Categories
        </button>
        <div class="absolute left-0 mt-2 w-40 bg-white border rounded shadow-lg 
                    opacity-0 group-hover:opacity-100 
                    transition-opacity duration-200 
                    z-10">
            <ul class="py-2 text-sm text-gray-700">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Add Category</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Manage Categories</a></li>
            </ul>
        </div>
    </div>

    <!-- Products Dropdown -->
    <div class="relative group">
        <button class="text-gray-700 hover:text-indigo-600 focus:outline-none">
            Products
        </button>
        <div class="absolute left-0 mt-2 w-40 bg-white border rounded shadow-lg 
                    opacity-0 group-hover:opacity-100 
                    transition-opacity duration-200 
                    z-10">
            <ul class="py-2 text-sm text-gray-700">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Add Product</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Manage Products</a></li>
            </ul>
        </div>
    </div>

    <!-- Right side: User + Logout -->
    <div class="ml-auto flex items-center gap-4">
        <span class="text-sm text-gray-600">
            {{ Auth::user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Logout
            </button>
        </form>
    </div>
</nav>
