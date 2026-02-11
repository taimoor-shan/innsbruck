<?php
/**
 * Template Name: All Properties
 *
 * Displays all properties with filters.
 *
 * @package TailPress
 */

get_header();

// 1. Hero (reusing hero component with page data)
$hero_title = get_the_title();
$hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: 'https://storage.googleapis.com/download/storage/v1/b/prd-shared-services.firebasestorage.app/o/h2m-assets%2Fb4cef5120d7ca8c5d3e060b4da4044d5a07da822.jpg?generation=1770502588636374&alt=media'; // Fallback

get_template_part('template-parts/components/hero', null, [
    'image' => $hero_image,
    'title' => $hero_title,
    'subtitle' => 'Explore our complete collection of properties',
    'height' => 'h-[50vh]'
]);

// 2. Get Filter Terms
$property_types = get_terms(['taxonomy' => 'property_type', 'hide_empty' => true]);
$property_statuses = get_terms(['taxonomy' => 'property_status', 'hide_empty' => true]);

// 3. Get Current Filters from URL
$current_type = get_query_var('property_type') ?: (isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '');
$current_status = get_query_var('property_status') ?: (isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '');

// 4. Build Query Args for Properties Loop
$loop_args = [
    'posts_per_page' => 12,
    'show_pagination' => true,
    'property_type' => $current_type,
    'property_status' => $current_status,
];
?>

<section class="bg-white py-12 md:py-20" x-data="propertiesFilter()">
    <div class="container mx-auto px-4">

        <!-- Filter Bar -->
        <div class="mb-12 space-y-6">

            <!-- Type Filter -->
            <?php if (!empty($property_types) && !is_wp_error($property_types)): ?>
                <div class="flex flex-wrap justify-center gap-4">
                    <button @click="updateFilter('type', '')"
                        class="px-6 py-2 rounded-full border-2 transition-all duration-300 pointer-events-auto cursor-pointer"
                        :class="!currentType ? 'bg-primary border-primary text-white' : 'bg-white border-gray/20 text-gray hover:border-primary hover:text-primary'">
                        All Types
                    </button>
                    <?php foreach ($property_types as $term): ?>
                        <button @click="updateFilter('type', '<?php echo esc_js($term->slug); ?>')"
                            class="px-6 py-2 rounded-full border-2 transition-all duration-300 pointer-events-auto cursor-pointer"
                            :class="currentType === '<?php echo esc_js($term->slug); ?>' ? 'bg-primary border-primary text-white' : 'bg-white border-gray/20 text-gray hover:border-primary hover:text-primary'">
                            <?php echo esc_html($term->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Status Filter -->
            <?php if (!empty($property_statuses) && !is_wp_error($property_statuses)): ?>
                <div class="flex flex-wrap justify-center gap-4 border-t border-gray/10 pt-6">
                    <span class="text-gray self-center mr-2">Status:</span>
                    <button @click="updateFilter('status', '')"
                        class="px-4 py-1 text-sm rounded-md border transition-all duration-300 pointer-events-auto cursor-pointer"
                        :class="!currentStatus ? 'bg-dark border-dark text-white' : 'bg-white border-gray/20 text-gray hover:border-dark hover:text-dark'">
                        Any
                    </button>
                    <?php foreach ($property_statuses as $term): ?>
                        <button @click="updateFilter('status', '<?php echo esc_js($term->slug); ?>')"
                            class="px-4 py-1 text-sm rounded-md border transition-all duration-300 pointer-events-auto cursor-pointer"
                            :class="currentStatus === '<?php echo esc_js($term->slug); ?>' ? 'bg-dark border-dark text-white' : 'bg-white border-gray/20 text-gray hover:border-dark hover:text-dark'">
                            <?php echo esc_html($term->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

        <!-- Properties Grid Container -->
        <div class="min-h-[400px]" @click="handlePagination($event)">

            <!-- Loading Skeletons -->
            <div x-show="isLoading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php for ($i = 0; $i < 6; $i++): ?>
                    <?php get_template_part('template-parts/components/card-skeleton'); ?>
                <?php endfor; ?>
            </div>

            <!-- Actual Content -->
            <div x-show="!isLoading" x-html="propertiesHtml" class="animate-fade-in"></div>

        </div>

    </div>
</section>

<script>
    function propertiesFilter() {
        return {
            currentType: '<?php echo esc_js($current_type); ?>',
            currentStatus: '<?php echo esc_js($current_status); ?>',
            paged: 1,
            isLoading: false,
            propertiesHtml: '',
            ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',

            init() {
                // Initial fetch
                this.fetchProperties();

                // Handle browser back/forward if needed, but for now simple state
                window.addEventListener('popstate', (event) => {
                    if (event.state) {
                        this.currentType = event.state.type || '';
                        this.currentStatus = event.state.status || '';
                        this.fetchProperties(false);
                    }
                });
            },

            updateFilter(type, slug) {
                if (type === 'type') this.currentType = (this.currentType === slug) ? '' : slug;
                if (type === 'status') this.currentStatus = (this.currentStatus === slug) ? '' : slug;

                this.paged = 1; // Reset to page 1 on filter change
                this.fetchProperties();
            },

            handlePagination(e) {
                const link = e.target.closest('.page-numbers');
                if (!link) return;

                e.preventDefault();

                const href = link.getAttribute('href');
                if (!href) return;

                // Extract paged arg from URL
                const url = new URL(href);
                const pagedParam = url.searchParams.get('paged');

                if (pagedParam) {
                    this.paged = parseInt(pagedParam);
                } else {
                    // Formatting might be /page/2/
                    const match = href.match(/\/page\/(\d+)\/?/);
                    if (match) {
                        this.paged = parseInt(match[1]);
                    } else {
                        this.paged = 1;
                    }
                }

                this.fetchProperties();

                // Scroll to top of grid
                this.$el.scrollIntoView({ behavior: 'smooth' });
            },

            fetchProperties(pushState = true) {
                this.isLoading = true;

                // Update URL
                if (pushState) {
                    const params = new URLSearchParams();
                    if (this.currentType) params.set('type', this.currentType);
                    if (this.currentStatus) params.set('status', this.currentStatus);
                    if (this.paged > 1) params.set('paged', this.paged);

                    const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
                    window.history.pushState({ type: this.currentType, status: this.currentStatus }, '', newUrl);
                }

                const formData = new FormData();
                formData.append('action', 'filter_properties');
                formData.append('property_type', this.currentType);
                formData.append('property_status', this.currentStatus);
                formData.append('paged', this.paged);

                fetch(this.ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.propertiesHtml = data.data.html;
                        }
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        // Small delay to prevent flickering if fast response, and to show off skeleton
                        setTimeout(() => {
                            this.isLoading = false;
                        }, 300);
                    });
            }
        }
    }
</script>

<?php
get_footer();
