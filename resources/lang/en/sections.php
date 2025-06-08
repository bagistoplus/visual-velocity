<?php

return [
    'top-bar' => [
        'settings' => [
            'announcement_label' => 'Announcement text',
            'announcement_default' => 'Get UPTO 40% OFF on your 1st order',

            'show_announcement_label' => 'Show announcement',
            'announcement_link_label' => 'Announcement link',
            'announcement_link_text_label' => 'Announcement link text',
            'announcement_link_text_default' => 'Shop Now',

            'show_currency_switcher_label' => 'Show currency switcher',
            'show_locale_switcher_label' => 'Show locale switcher',
        ]
    ],

    'header' => [
        'name' => 'Header',
        'description' => '',
        'blocks' => [
            'logo' => [
                'name' => 'Logo/Name',
                'settings' => [
                    'logo_image_label' => 'Logo image',
                    'logo_text_label' => 'Logo text',
                    'logo_text_default' => config('app.name'),
                    'logo_text_info' => 'Displayed when no logo image is set',
                ],
            ],

            'navigation' => [
                'name' => 'Navigation',
                'settings' => [
                    'show_in_sidebar_label' => 'Show in sidebar',
                    'number_of_items_in_header_label' => 'Number of items in header',
                ],
            ],

            'search' => [
                'name' => 'Search',
                'settings' => [
                    'search_icon_label' => 'Search icon',
                    'image_search_icon_label' => 'Image search icon',
                ],
            ],

            'compare' => [
                'name' => 'Compare',
                'settings' => [
                    'icon_label' => 'Icon',
                ],
            ],

            'minicart' => [
                'name' => 'Mini Cart',
                'settings' => [
                    'icon_label' => 'Icon',
                    'heading_label' => 'Heading',
                    'description_label' => 'Description',
                    'description_default' => 'Get Up To 30% OFF on your 1st order',
                ],
            ],

            'user' => [
                'name' => 'User',
                'settings' => [
                    'icon_label' => 'Icon',
                    'guest_heading_label' => 'Heading shown to guest users',
                    'guest_description_label' => 'Description shown to guest users',
                ],
            ],
        ],
    ],

    'mobile-header' => [
        'name' => 'Mobile Header',
        'description' => 'Responsive header with drawer, logo, and customer navigation for mobile devices.',

        'settings' => [
            'logo_label' => 'Logo Image',
            'logo_text_label' => 'Logo Text (fallback)',
        ]
    ],

    'footer' => [
        'name' => 'Footer',
        'description' => 'The bottom section of your website with links and branding.',

        'settings' => [
            'copyright_label' => 'Copyright',
            'copyright_default' => "© Copyright 2010 - " . date('Y') . ", Webkul Software (Registered in India). All rights reserved.",
        ],

        'blocks' => [
            'group' => [
                'name' => 'Links group',
                'settings' => [
                    'title_label' => 'Group name',
                    'title_default' => 'Links group',
                ],
            ],
            'link' => [
                'name' => 'Link',
                'settings' => [
                    'text_label' => 'Link Text ',
                    'text_default' => 'Link',

                    'link_label' => 'Link',
                ],
            ],
        ],
    ],

    'slideshow' => [
        'name' => 'Slideshow',
        'description' => 'A slideshow section with multiple slides.',
        'blocks' => [
            'slide' => [
                'name' => 'Slide',
                'settings' => [
                    'heading_label' => 'Heading',
                    'heading_size_label' => 'Heading size',

                    'subheading_label' => 'Subheading',
                    'subheading_size_label' => 'Subheading size',

                    'size_small'    => 'Small',
                    'size_medium'   => 'Medium',
                    'size_large'    => 'Large',
                    'size_xlarge'   => 'Extra Large',
                    'size_2xlarge'  => '2x Extra Large',

                    'button_text_label' => 'Button text',
                    'button_link_label' => 'Button link',
                    'image_label' => 'Image',
                    'image_info' => 'Recommended size: 1920x700px',

                    'content_placement_label' => 'Content Placement',
                    'placement_center' => 'Center',
                    'placement_left'   => 'Left',
                    'placement_right'  => 'Right',
                ],
            ],
        ],
    ],

    'promo-banner' => [
        'name' => 'Promo Banner',
        'description' => 'A promotional banner section.',
        'settings' => [
            'text_label' => 'Text',
            'text_default' => 'Get UPTO 40% OFF on your 1st order SHOP NOW',
            'link_label' => 'Link',
        ],
    ],

    'category-carousel' => [
        'name' => 'Category Carousel',
        'description' => 'Displays a horizontal carousel of categories, either selected manually or based on selected filters.',

        'settings' => [
            'parent_label'    => 'Parent Category',
            'sort_label'      => 'Sort Direction',
            'sort_asc'        => 'Ascending',
            'sort_desc'       => 'Descending',
            'limit_label'     => 'Limit',
            'name_label'      => 'Name Filter',
            'status_label'    => 'Only Active Categories',
        ],

        'blocks' => [
            'category' => [
                'label' => 'Category',
                'settings' => [
                    'category_label' => 'Select Category',
                ],
            ],
        ],
    ],

    'product-carousel' => [
        'name' => 'Product Carousel',
        'description' => 'Displays a carousel of products based on selected filters or handpicked products.',

        'settings' => [
            'heading_label'             => 'Heading',
            'heading_default' => 'New products',
            'category_label'            => 'Filter by Category',
            'sort_label'                => 'Sort By',
            'sort' => [
                'name_asc'             => 'Name (A-Z)',
                'name_desc'            => 'Name (Z-A)',
                'created_at_asc'       => 'Oldest First',
                'created_at_desc'      => 'Newest First',
                'price_asc'            => 'Price (Low to High)',
                'price_desc'           => 'Price (High to Low)',
            ],
            'limit_label'               => 'Limit',
            'filter_new_label'          => 'Filter new products',
            'filter_featured_label'     => 'Filter featured products',
        ],

        'blocks' => [
            'product' => [
                'name' => 'Product',
                'settings' => [
                    'product_label' => 'Select Product',
                ],
            ],
        ],
    ],

    'collection-tiles' => [
        'name' => 'Collection Tiles',
        'description' => 'A grid of collection tiles with custom images and links.',

        'settings' => [
            'heading_label' => 'Heading',
            'columns_desktop_label' => 'Columns on Desktop',
            'columns_mobile_label' => 'Columns on Mobile',
            'image_ratio_label' => 'Image Ratio',
            'text_alignment_vertical_label' => 'Vertical Text Alignment',
            'text_alignment_horizontal_label' => 'Horizontal Text Alignment',

            'image_ratio' => [
                'square' => 'Square',
                'portrait' => 'Portrait',
                'landscape' => 'Landscape',
            ],

            'text_alignment' => [
                'top' => 'Top',
                'center' => 'Center',
                'bottom' => 'Bottom',
                'start' => 'Left',
                'center' => 'Center',
                'end' => 'Right',
            ],
        ],

        'blocks' => [
            'tile' => [
                'name' => 'Tile',
                'settings' => [
                    'image_label' => 'Image',
                    'title_label' => 'Title',
                    'link_label' => 'Link',
                ],
            ],
        ],
    ],

    'text-with-image' => [
        'name'        => 'Text with Image',
        'description' => 'Show text content alongside an image with configurable layout.',

        'settings' => [
            'image_label'           => 'Image',
            'image_position_label'  => 'Image Position',
            'left_label'            => 'Image first',
            'right_label'           => 'Image second',

            'image_height_label'    => 'Image Height',
            'image_height_auto'     => 'Adapt to Image',
            'image_height_sm'       => 'Small',
            'image_height_md'       => 'Medium',
            'image_height_lg'       => 'Large',

            'image_width_label'     => 'Image Width (Desktop)',
            'width_sm'              => 'Small',
            'width_md'              => 'Medium',
            'width_lg'              => 'Large',

            'content_position_label'    => 'Content Position (Vertical)',
            'position_top'              => 'Top',
            'position_middle'           => 'Middle',
            'position_bottom'           => 'Bottom',

            'content_align_label'       => 'Content Alignment (Desktop)',
            'content_align_mobile_label' => 'Content Alignment (Mobile)',
            'align_start'               => 'Start',
            'align_center'              => 'Center',
            'align_end'                 => 'End',
        ],

        'blocks' => [
            'heading' => [
                'label' => 'Heading',
                'settings' => [
                    'text_label' => 'Heading Text',
                    'text_default' => 'Image with text'
                ],
            ],
            'body' => [
                'label' => 'Body Text',
                'settings' => [
                    'content_label' => 'Paragraph Text',
                    'content_default' => 'Pair text with an image to focus on your chosen product, collection, or blog post. Add details on availability, style, or even provide a review'
                ],
            ],
            'button' => [
                'label' => 'Button',
                'settings' => [
                    'text_label' => 'Button Text',
                    'url_label'  => 'Button URL',
                    'text_default' => 'Button Text',
                    'variant_label'        => 'Button Variant',

                    'variant_primary'      => 'Primary',
                    'variant_secondary'    => 'Secondary',
                    'variant_accent'       => 'Accent',
                    'variant_neutral'      => 'Neutral',

                    'style_label'          => 'Button Style',
                    'style_solid'          => 'Solid',
                    'style_soft'           => 'Soft',
                    'style_outline'        => 'Outline',
                    'style_ghost'          => 'Ghost',
                ],
            ],
        ],
    ],

    'feature-icons' => [
        'name' => 'Feature Icons',
        'description' => 'Display a row of icons with titles and short descriptions.',

        'settings' => [
            'icon_size_label'   => 'Icon Size (px)',
            'columns_label'     => 'Columns on Desktop',
        ],

        'blocks' => [
            'feature' => [
                'label' => 'Feature',
                'settings' => [
                    'icon_label'  => 'Icon',
                    'title_label' => 'Title',
                    'text_label'  => 'Description',
                ],
            ],
        ],

        'placeholders' => [
            'title' => 'Heading',
            'text'  => 'Some followup text to build on the feature',
        ],
    ],
];
