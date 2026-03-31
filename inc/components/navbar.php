
<?php
require_once __DIR__ . '/../category/fonctions.php';
$categories = getCategories();
?>
<style>


.categories-bar {
    background: var(--navy);
    /*background: linear-gradient(180deg, rgba(26, 48, 85, 0.6) 0%, rgba(10, 31, 62, 0.4) 100%);*/
    padding: 1rem 2rem;
    /*border-bottom: 1px solid rgba(44, 90, 160, 0.3);*/
    /*box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);*/
    position: sticky;
    top: 75px;
    z-index: 999;
    display: flex;
    justify-content: center;
}

.categories-scroll {
    display: flex;
    gap: 0.75rem;
    overflow-x: auto;
    scroll-behavior: smooth;
    align-items: center;
    max-width: 100%;
    justify-content: center;
    flex-wrap: nowrap;
}

.categories-scroll::-webkit-scrollbar {
    height: 4px;
}

.categories-scroll::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
}

.categories-scroll::-webkit-scrollbar-thumb {
    background: rgba(44, 90, 160, 0.6);
    border-radius: 10px;
    transition: background 0.3s ease;
}

.categories-scroll::-webkit-scrollbar-thumb:hover {
    background: var(--blue-accent);
}

.category-tag {
    display: inline-flex;
    align-items: center;
    padding: 0.45rem 1.1rem;
    background: rgba(44, 90, 160, 0.85);
    color: var(--white);
    text-decoration: none;
    border-radius: 20px;
    white-space: nowrap;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    font-family: 'Segoe UI', sans-serif;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.category-tag::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    transition: left 0.3s ease;
    z-index: -1;
}

.category-tag:hover::before {
    left: 0;
}

.category-tag:hover {
    background: var(--blue-accent);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(44, 90, 160, 0.4);
}

</style>
<!-- Navbar -->
    <nav class="navbar">
        <a href="/fo/home" class="navbar-brand">Karakory</a>
        <div class="navbar-center">
            <div class="search-box">
                <form method="GET" action="/search/results" style="display: flex; width: 100%; align-items: center;">
                    <input 
                        type="text" 
                        name="q"
                        placeholder="Rechercher un article..."
                        id="searchInput"
                        required
                    >
                    <button type="submit" title="Rechercher">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="navbar-right">
            <a href="/login/form" class="btn-login">Se connecter</a>
        </div>
    </nav>

    <!-- Categories Bar -->
    <div class="categories-bar">
        <div class="categories-scroll">
            <?php foreach ($categories as $category): ?>
                <a href="/fo/category?slug=<?php echo htmlspecialchars($category['slug']); ?>" class="category-tag">
                    <?php echo htmlspecialchars($category['nom']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
