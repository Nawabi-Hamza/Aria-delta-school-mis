<style>
    .gt_selector {
        border: 1px solid var(--secondary-text-color);
        background: none;
        padding: .2em;
        color: var(--primary-text-color);
    }
</style>

<nav class="d-flex justify-content-between align-items-center bg--primary  px-4">
    <h2 class="fw-bold">Teacher Dashboard</h2>
    <ul class="d-flex justify-content-between mt-2 me-4 gap-4 align-items-center">
         <li>
            <div class="gtranslate_wrapper border border-dark rounded"></div>
            <script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"languages":["en","fr","ar","fa","ps"],"wrapper_selector":".gtranslate_wrapper"}</script>
            <!-- <script src="https://cdn.gtranslate.net/widgets/latest/dropdown.js" defer></script> -->
            <script src="../assets/plugins/g-translate.js" defer></script>
         </li>
        <li class="d-none d-md-block"><a href="" class="nav-link"><i class="bi bi-person-circle h3"></i></a></li>
    </ul>
</nav>


<script>
    // Function to update direction based on lang attribute
    function updateDirection() {
        const lang = document.documentElement.getAttribute("lang"); // Get the current lang attribute
        
        if (["ar", "fa", "ps"].includes(lang)) {
            document.documentElement.setAttribute("dir", "rtl");
        } else {
            document.documentElement.setAttribute("dir", "ltr");
        }
    }

    // Create a MutationObserver to watch for changes in the lang attribute
    const observer = new MutationObserver(() => {
        updateDirection(); // Call function when lang changes
    });

    // Start observing changes in the lang attribute of the <html> tag
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ["lang"] // Only watch for lang attribute changes
    });

    // Initial direction setup in case the page starts with a different language
    updateDirection();
</script>

