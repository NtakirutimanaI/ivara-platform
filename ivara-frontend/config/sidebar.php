<?php

return [
    'menus' => [
        // --- ADMIN & MANAGEMENT ROLES ---
        'super_admin' => [
            ['label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => 'super_admin.index'],
            
            // Category Management (Enhanced)
            // Category Management
            ['label' => 'Manage All Categories', 'icon' => 'fas fa-layer-group', 'route' => 'super_admin.categories.index'],

            // Admin Management (Updated)
            [
                'label' => 'Team Management', 
                'icon' => 'fas fa-users-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Admins', 'icon' => 'fas fa-user-shield', 'route' => 'super_admin.admins.index'],
                    ['label' => 'Managers', 'icon' => 'fas fa-user-tie', 'route' => 'super_admin.managers.index'],
                    ['label' => 'Supervisors', 'icon' => 'fas fa-user-check', 'route' => 'super_admin.supervisors.index'],
                    ['label' => 'Performance Matrix', 'icon' => 'fas fa-chart-bar', 'route' => 'super_admin.performance.index'],
                ]
            ],

            ['label' => 'Users (All Businesses)', 'icon' => 'fas fa-users', 'route' => 'super_admin.users.index'],
            ['label' => 'Roles & Permissions', 'icon' => 'fas fa-user-shield', 'route' => 'super_admin.roles.index'],

            ['label' => 'Marketplace', 'icon' => 'fas fa-store', 'route' => 'super_admin.marketplace.index'],
            ['label' => 'Businesses (Tenants)', 'icon' => 'fas fa-building', 'route' => 'super_admin.businesses.index'],
            ['label' => 'Manage Credentials', 'icon' => 'fas fa-key', 'route' => 'super_admin.credentials'],
            
            [
                'label' => 'Subscriptions',
                'icon' => 'fas fa-crown',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Plans', 'icon' => 'fas fa-list-alt', 'route' => 'super_admin.subscriptions.plans'],
                    ['label' => 'Active Subscriptions', 'icon' => 'fas fa-check-circle', 'route' => 'super_admin.subscriptions.active'],
                    ['label' => 'Subscription Payments', 'icon' => 'fas fa-credit-card', 'route' => 'super_admin.subscriptions.payments'],
                ],
            ],
            ['label' => 'Licenses Management', 'icon' => 'fas fa-id-card', 'route' => 'super_admin.licenses.index'],
            ['label' => 'Services Registry', 'icon' => 'fas fa-concierge-bell', 'route' => 'super_admin.services.index'],
            ['label' => 'Courses & Training', 'icon' => 'fas fa-graduation-cap', 'route' => 'super_admin.courses.index'],
            
            // Finance & Billing (Merged)
            [
                'label' => 'Finance & Billing',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Control Billing Rules', 'icon' => 'fas fa-gavel', 'route' => 'super_admin.billing.rules'],
                    ['label' => 'Payments', 'icon' => 'fas fa-money-bill-wave', 'route' => 'super_admin.payments.index'],
                    ['label' => 'Invoices', 'icon' => 'fas fa-file-invoice', 'route' => 'super_admin.invoices.index'],
                ]
            ],

            ['label' => 'Platform Analytics', 'icon' => 'fas fa-chart-line', 'route' => 'super_admin.analytics.index'],
            ['label' => 'Audit Logs', 'icon' => 'fas fa-clipboard-list', 'route' => 'super_admin.logs.audit'],
            ['label' => 'Global Settings', 'icon' => 'fas fa-cogs', 'route' => 'super_admin.settings.index'],
            ['label' => 'Support & Tickets', 'icon' => 'fas fa-headset', 'route' => 'super_admin.support.index'],
        ],
        'admin' => [
            ['label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => 'admin.index'],
            ['label' => 'Business Profile', 'icon' => 'fas fa-id-card', 'route' => 'admin.profile'],
            [
                'label' => 'User Management',
                'icon' => 'fas fa-users-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Management Staff', 'icon' => 'fas fa-user-tie', 'route' => 'admin.staff.admins'],
                    ['label' => 'Field Staff / Pro', 'icon' => 'fas fa-tools', 'route' => 'admin.staff.technicians'],
                    ['label' => 'Clients (Customers)', 'icon' => 'fas fa-user-friends', 'route' => 'admin.staff.clients'],
                ],
            ],
            [
                'label' => 'Device Security Hub',
                'icon' => 'fas fa-shield-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Security Search (IMEI)', 'icon' => 'fas fa-search', 'route' => 'admin.devices.all'],
                    ['label' => 'Register Device', 'icon' => 'fas fa-laptop-medical', 'route' => 'admin.devices.register'],
                    ['label' => 'Ownership History', 'icon' => 'fas fa-history', 'route' => 'admin.devices.ownership_history'],
                    ['label' => 'Stolen/Lost Reports', 'icon' => 'fas fa-exclamation-triangle', 'route' => 'admin.devices.stolen'],
                    ['label' => 'Device Recovery', 'icon' => 'fas fa-undo', 'route' => 'admin.devices.recovered'],
                    ['label' => 'Live Tracking Map', 'icon' => 'fas fa-map-marker-alt', 'route' => 'admin.devices.tracking'],
                ],
            ],
            [
                'label' => 'Inventory System',
                'icon' => 'fas fa-warehouse',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Product Imports', 'icon' => 'fas fa-box-open', 'route' => 'admin.products.imported'],
                    ['label' => 'Electronic Devices', 'icon' => 'fas fa-laptop', 'route' => 'admin.products.imported'],
                    ['label' => 'Spare Parts Inventory', 'icon' => 'fas fa-cogs', 'route' => 'admin.spare_parts.inventory'],
                    ['label' => 'Stock Monitoring', 'icon' => 'fas fa-chart-line', 'route' => 'admin.stock.levels'],
                    ['label' => 'Suppliers Management', 'icon' => 'fas fa-truck-loading', 'route' => 'admin.suppliers.index'],
                ],
            ],
            [
                'label' => 'Management Ops',
                'icon' => 'fas fa-tasks',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Our Services', 'icon' => 'fas fa-concierge-bell', 'route' => 'admin.technical-repair.services'],
                    ['label' => 'Bookings / Repairs', 'icon' => 'fas fa-wrench', 'route' => 'admin.repairs.all'],
                    ['label' => 'Repair Assignments', 'icon' => 'fas fa-user-plus', 'route' => 'admin.repairs.assign_technicians'],
                ],
            ],
            [
                'label' => 'Finance & Invoices',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Generate Invoices', 'icon' => 'fas fa-file-invoice', 'route' => 'admin.invoices.sales'],
                    ['label' => 'All Payments', 'icon' => 'fas fa-credit-card', 'route' => 'admin.payments'],
                    ['label' => 'Business Incomes', 'icon' => 'fas fa-trending-up', 'route' => 'admin.income.index'],
                    ['label' => 'Business Expenses', 'icon' => 'fas fa-trending-down', 'route' => 'admin.expenses.index'],
                    ['label' => 'Financial Reports', 'icon' => 'fas fa-chart-pie', 'route' => 'admin.reports.financial'],
                ],
            ],
            [
                'label' => 'Platform Access',
                'icon' => 'fas fa-key',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Subscriptions', 'icon' => 'fas fa-crown', 'route' => 'admin.subscriptions.index'],
                    ['label' => 'Licences Registry', 'icon' => 'fas fa-id-card', 'route' => 'admin.subscriptions.index'],
                ],
            ],
            ['label' => 'Courses & Training', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
            ['label' => 'Platform Settings', 'icon' => 'fas fa-cogs', 'route' => 'admin.settings'],
        ],
        'manager' => [
            ['label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => 'manager.index'],
            [
                'label' => 'Staff Tracking',
                'icon' => 'fas fa-id-badge',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Field Teams', 'icon' => 'fas fa-users-cog', 'route' => 'manager.staff.technicians'],
                    ['label' => 'Performance', 'icon' => 'fas fa-star', 'route' => 'manager.staff.performance'],
                    ['label' => 'Attendance', 'icon' => 'fas fa-calendar-check', 'route' => 'manager.staff.attendance'],
                ],
            ],
            [
                'label' => 'Inventory & Supplies',
                'icon' => 'fas fa-warehouse',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Branch Stock', 'icon' => 'fas fa-boxes', 'route' => 'manager.products.index'],
                    ['label' => 'Spare Parts', 'icon' => 'fas fa-cogs', 'route' => 'manager.spare_parts.index'],
                    ['label' => 'Reorder Requests', 'icon' => 'fas fa-sync', 'route' => 'manager.stock.reorder'],
                ],
            ],
            [
                'label' => 'Operations',
                'icon' => 'fas fa-tools',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Repair Queue', 'icon' => 'fas fa-tasks', 'route' => 'manager.repairs.requests'],
                    ['label' => 'Device Verification', 'icon' => 'fas fa-check-circle', 'route' => 'manager.devices.verify'],
                    ['label' => 'Stolen Reports View', 'icon' => 'fas fa-user-secret', 'route' => 'manager.devices.stolen'],
                ],
            ],
            [
                'label' => 'Financial View',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Invoices Log', 'icon' => 'fas fa-receipt', 'route' => 'manager.invoices.view'],
                    ['label' => 'Payments Collected', 'icon' => 'fas fa-money-bill-wave', 'route' => 'manager.payments'],
                    ['label' => 'Branch Expenses', 'icon' => 'fas fa-arrow-down', 'route' => 'manager.reports.inventory'],
                ],
            ],
            ['label' => 'Courses & Training', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'supervisor' => [
            ['label' => 'Command Center', 'icon' => 'fas fa-satellite', 'route' => 'supervisor.index'],
            [
                'label' => 'Field Oversight',
                'icon' => 'fas fa-users-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Specialists', 'icon' => 'fas fa-user-check', 'route' => 'supervisor.staff.task_assignments'],
                    ['label' => 'Live Repair Status', 'icon' => 'fas fa-play-circle', 'route' => 'supervisor.dashboard.live_status'],
                ],
            ],
            [
                'label' => 'Security & Verification',
                'icon' => 'fas fa-shield-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Device Registry', 'icon' => 'fas fa-laptop-medical', 'route' => 'supervisor.devices.register'],
                    ['label' => 'Verify Ownership', 'icon' => 'fas fa-qrcode', 'route' => 'supervisor.devices.verify'],
                ],
            ],
            [
                'label' => 'Material Registry',
                'icon' => 'fas fa-boxes',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Parts Availability', 'icon' => 'fas fa-warehouse', 'route' => 'supervisor.spare_parts.availability'],
                    ['label' => 'Issue Materials', 'icon' => 'fas fa-hand-holding', 'route' => 'supervisor.spare_parts.issue'],
                ],
            ],
            ['label' => 'Training Access', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'technician' => [
            ['label' => 'Job Board', 'icon' => 'fas fa-clipboard-list', 'route' => 'technician.index'],
            [
                'label' => 'My Work',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Repairs', 'icon' => 'fas fa-play', 'route' => 'technician.repairs.assigned'],
                    ['label' => 'Device Scanning', 'icon' => 'fas fa-qrcode', 'route' => 'technician.devices.scan'],
                    ['label' => 'Security Registration', 'icon' => 'fas fa-plus-square', 'route' => 'technician.devices.register'],
                    ['label' => 'Work Progress', 'icon' => 'fas fa-sync', 'route' => 'technician.repairs.update_status'],
                ],
            ],
            [
                'label' => 'Resource Request',
                'icon' => 'fas fa-box-open',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Parts', 'icon' => 'fas fa-hand-holding-medical', 'route' => 'technician.parts.request'],
                    ['label' => 'Logged Parts Use', 'icon' => 'fas fa-history', 'route' => 'technician.parts.used'],
                ],
            ],
            ['label' => 'Earnings & Wallet', 'icon' => 'fas fa-wallet', 'route' => 'technician.earnings.my_earnings'],
            ['label' => 'Training Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'mechanic' => [ 
            ['label' => 'Mechanician Hub', 'icon' => 'fas fa-cog', 'route' => 'mechanic.index'],
            [
                'label' => 'Field Services',
                'icon' => 'fas fa-tools',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Repairs', 'icon' => 'fas fa-wrench', 'route' => 'mechanic.repairs.assigned'],
                    ['label' => 'Device/Tool Scan', 'icon' => 'fas fa-qrcode', 'route' => 'mechanic.devices.scan'],
                    ['label' => 'Equipment Registry', 'icon' => 'fas fa-id-card', 'route' => 'mechanic.devices.register'],
                ],
            ],
            [
                'label' => 'Resources',
                'icon' => 'fas fa-oil-can',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Supplies', 'icon' => 'fas fa-hand-holding', 'route' => 'mechanic.parts.request'],
                    ['label' => 'Supplies Log', 'icon' => 'fas fa-history', 'route' => 'mechanic.parts.log'],
                ],
            ],
            ['label' => 'Earnings', 'icon' => 'fas fa-wallet', 'route' => 'mechanic.earnings.summary'],
            ['label' => 'Professional Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'business' => [ 
            ['label' => 'Business Person Hub', 'icon' => 'fas fa-briefcase', 'route' => 'business.index'],
            [
                'label' => 'Inventory & Imports',
                'icon' => 'fas fa-ship',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Imported Stock', 'icon' => 'fas fa-boxes', 'route' => 'business.products.index'],
                    ['label' => 'Spare Parts Shop', 'icon' => 'fas fa-cogs', 'route' => 'business.products.parts'],
                    ['label' => 'Pricing Management', 'icon' => 'fas fa-tag', 'route' => 'business.products.pricing'],
                ],
            ],
            [
                'label' => 'Sales & Clients',
                'icon' => 'fas fa-shopping-cart',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Customers', 'icon' => 'fas fa-users', 'route' => 'business.clients.index'],
                    ['label' => 'Marketplace Orders', 'icon' => 'fas fa-receipt', 'route' => 'business.marketplace.orders'],
                ],
            ],
            [
                'label' => 'Financial Center',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Invoices', 'icon' => 'fas fa-file-invoice', 'route' => 'business.invoices.index'],
                    ['label' => 'Incomes/Expenses', 'icon' => 'fas fa-chart-line', 'route' => 'business.reports.sales'],
                    ['label' => 'Platform Subscriptions', 'icon' => 'fas fa-crown', 'route' => 'business.subscription.status'],
                ],
            ],
            ['label' => 'Business Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'mediator' => [
            ['label' => 'Mediation Desk', 'icon' => 'fas fa-balance-scale', 'route' => 'mediator.index'],
            [
                'label' => 'Active Cases',
                'icon' => 'fas fa-gavel',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Repair Disputes', 'icon' => 'fas fa-wrench', 'route' => 'mediator.disputes.repair'],
                    ['label' => 'Sales Disputes', 'icon' => 'fas fa-shopping-cart', 'route' => 'mediator.disputes.sales'],
                    ['label' => 'Security/Theft Claims', 'icon' => 'fas fa-shield-alt', 'route' => 'mediator.disputes.theft'],
                ],
            ],
            ['label' => 'Resolution Reports', 'icon' => 'fas fa-file-contract', 'route' => 'mediator.reports.resolution'],
            ['label' => 'Legal Training', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'client' => [
            ['label' => 'Client Portal', 'icon' => 'fas fa-home', 'route' => 'client.index'],
            [
                'label' => 'Secured Devices',
                'icon' => 'fas fa-shield-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register for Tracking', 'icon' => 'fas fa-plus-circle', 'route' => 'client.devices.register'],
                    ['label' => 'My Registered Devices', 'icon' => 'fas fa-laptop', 'route' => 'client.devices.list'],
                    ['label' => 'Report Stolen/Lost', 'icon' => 'fas fa-exclamation-triangle', 'route' => 'client.security.report_stolen'],
                    ['label' => 'Track on Map', 'icon' => 'fas fa-map-marker-alt', 'route' => 'client.security.track'],
                ],
            ],
            [
                'label' => 'Services & Orders',
                'icon' => 'fas fa-tools',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Book a Repair', 'icon' => 'fas fa-calendar-check', 'route' => 'client.repairs.request'],
                    ['label' => 'Order Products/Parts', 'icon' => 'fas fa-shopping-bag', 'route' => 'client.marketplace.browse'],
                    ['label' => 'Repair History', 'icon' => 'fas fa-history', 'route' => 'client.repairs.history'],
                ],
            ],
            [
                'label' => 'Financial & Access',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Invoices', 'icon' => 'fas fa-file-invoice', 'route' => 'client.invoices.index'],
                    ['label' => 'Buy Platform Licences', 'icon' => 'fas fa-id-card', 'route' => 'client.payments.index'],
                ],
            ],
            ['label' => 'Educational Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'craftsperson' => [
            ['label' => 'Craft Hub', 'icon' => 'fas fa-hammer', 'route' => 'craftsperson.index'],
            [
                'label' => 'My Work Orders',
                'icon' => 'fas fa-clipboard-list',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Projects', 'icon' => 'fas fa-tasks', 'route' => 'craftsperson.jobs.assigned'],
                    ['label' => 'Progress Log', 'icon' => 'fas fa-pen-alt', 'route' => 'craftsperson.jobs.update_status'],
                ],
            ],
            [
                'label' => 'Toolbox Registry',
                'icon' => 'fas fa-tools',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Tools', 'icon' => 'fas fa-plus', 'route' => 'craftsperson.tools.register'],
                    ['label' => 'Security Verification', 'icon' => 'fas fa-qrcode', 'route' => 'craftsperson.tools.verify'],
                ],
            ],
            ['label' => 'My Earnings', 'icon' => 'fas fa-wallet', 'route' => 'craftsperson.earnings.summary'],
            ['label' => 'Advanced Crafting Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'tailor' => [
            ['label' => 'Tailoring Studio', 'icon' => 'fas fa-cut', 'route' => 'tailor.index'],
            [
                'label' => 'Customer Orders',
                'icon' => 'fas fa-shopping-bag',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Measurements Log', 'icon' => 'fas fa-ruler-combined', 'route' => 'tailor.measurements.record'],
                    ['label' => 'Fabric/Order Status', 'icon' => 'fas fa-sync', 'route' => 'tailor.orders.update_status'],
                    ['label' => 'Completed Garments', 'icon' => 'fas fa-check-circle', 'route' => 'tailor.orders.completed'],
                ],
            ],
            ['label' => 'Earnings & Payments', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'tailor.earnings.payments'],
            ['label' => 'Fashion Design Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'builder' => [
            ['label' => 'Construction Desk', 'icon' => 'fas fa-hard-hat', 'route' => 'builder.index'],
            [
                'label' => 'Site Projects',
                'icon' => 'fas fa-city',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Sites', 'icon' => 'fas fa-map-marked-alt', 'route' => 'builder.projects.assigned'],
                    ['label' => 'Work Timeline', 'icon' => 'fas fa-calendar-alt', 'route' => 'builder.projects.update_progress'],
                ],
            ],
            [
                'label' => 'Equipment & Materials',
                'icon' => 'fas fa-cubes',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Materials', 'icon' => 'fas fa-dolly', 'route' => 'builder.materials.request'],
                    ['label' => 'Register Heavy Gear', 'icon' => 'fas fa-truck-monster', 'route' => 'builder.equipment.register'],
                ],
            ],
            ['label' => 'Project Earnings', 'icon' => 'fas fa-wallet', 'route' => 'builder.payments.earnings'],
            ['label' => 'Engineering Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        'electrician' => [
            ['label' => 'Electrical Panel', 'icon' => 'fas fa-bolt', 'route' => 'electrician.index'],
            [
                'label' => 'Service Jobs',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Current Repairs', 'icon' => 'fas fa-tools', 'route' => 'electrician.repairs.assigned'],
                    ['label' => 'Safety Checklist', 'icon' => 'fas fa-clipboard-check', 'route' => 'electrician.repairs.update_progress'],
                ],
            ],
            [
                'label' => 'Component Security',
                'icon' => 'fas fa-shield-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Components', 'icon' => 'fas fa-id-card', 'route' => 'electrician.devices.register'],
                    ['label' => 'Material Supply', 'icon' => 'fas fa-plug', 'route' => 'electrician.materials.request'],
                ],
            ],
            ['label' => 'Earnings Log', 'icon' => 'fas fa-wallet', 'route' => 'electrician.earnings.index'],
            ['label' => 'Electrical Safety Courses', 'icon' => 'fas fa-graduation-cap', 'route' => 'admin.courses.index'],
        ],

        // --- TRANSPORT & TRAVEL ROLES ---
        'taxi_driver' => [
            ['label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => 'taxi_driver.transport-travel.index'],
            ['label' => 'My Bookings', 'icon' => 'fas fa-route', 'route' => 'taxi_driver.transport-travel.bookings'],
            ['label' => 'My Vehicle', 'icon' => 'fas fa-car', 'route' => 'taxi_driver.transport-travel.vehicle'],
            ['label' => 'Earnings', 'icon' => 'fas fa-wallet', 'route' => 'taxi_driver.transport-travel.earnings'],
            ['label' => 'Notifications', 'icon' => 'fas fa-bell', 'route' => 'taxi_driver.transport-travel.notifications'],
            ['label' => 'My Profile', 'icon' => 'fas fa-user-circle', 'route' => 'taxi_driver.transport-travel.profile'],
        ],
        'moto_driver' => [
            ['label' => 'Moto Dash', 'icon' => 'fas fa-motorcycle', 'route' => 'moto_driver.transport-travel.index'],
            ['label' => 'My Trips', 'icon' => 'fas fa-road', 'route' => 'moto_driver.transport-travel.trips'],
            ['label' => 'Bike Status', 'icon' => 'fas fa-tachometer-alt', 'route' => 'moto_driver.transport-travel.vehicle'],
            ['label' => 'Earnings', 'icon' => 'fas fa-wallet', 'route' => 'moto_driver.transport-travel.earnings'],
            ['label' => 'Notifications', 'icon' => 'fas fa-bell', 'route' => 'moto_driver.transport-travel.notifications'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'moto_driver.transport-travel.profile'],
        ],
        'bus_driver' => [
            ['label' => 'Bus Operations', 'icon' => 'fas fa-bus', 'route' => 'bus_driver.transport-travel.index'],
            ['label' => 'Schedule', 'icon' => 'fas fa-clock', 'route' => 'bus_driver.transport-travel.schedule'],
            ['label' => 'Ticket Log', 'icon' => 'fas fa-ticket-alt', 'route' => 'bus_driver.transport-travel.tickets'],
            ['label' => 'Vehicle Check', 'icon' => 'fas fa-wrench', 'route' => 'bus_driver.transport-travel.vehicle'],
            ['label' => 'Earnings', 'icon' => 'fas fa-wallet', 'route' => 'bus_driver.transport-travel.earnings'],
            ['label' => 'Notifications', 'icon' => 'fas fa-bell', 'route' => 'bus_driver.transport-travel.notifications'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'bus_driver.transport-travel.profile'],
        ],
        'truck_driver' => [ // Added Truck Driver
            ['label' => 'Truck Command', 'icon' => 'fas fa-truck-moving', 'route' => 'truck_driver.transport-travel.index'],
            ['label' => 'Shipments', 'icon' => 'fas fa-boxes', 'route' => 'truck_driver.transport-travel.shipments'],
            ['label' => 'Logbook', 'icon' => 'fas fa-clipboard-list', 'route' => 'truck_driver.transport-travel.logs'],
            ['label' => 'Vehicle Status', 'icon' => 'fas fa-truck-monster', 'route' => 'truck_driver.transport-travel.vehicle'],
            ['label' => 'Earnings', 'icon' => 'fas fa-wallet', 'route' => 'truck_driver.transport-travel.earnings'],
            ['label' => 'Notifications', 'icon' => 'fas fa-bell', 'route' => 'truck_driver.transport-travel.notifications'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'truck_driver.transport-travel.profile'],
        ],
        'tour_driver' => [
            ['label' => 'Tour Guide', 'icon' => 'fas fa-map-marked-alt', 'route' => 'tour_driver.transport-travel.index'],
            ['label' => 'My Bookings', 'icon' => 'fas fa-calendar-alt', 'route' => 'tour_driver.transport-travel.bookings'],
            ['label' => 'Destinations', 'icon' => 'fas fa-monument', 'route' => 'tour_driver.transport-travel.destinations'],
            ['label' => 'Earnings', 'icon' => 'fas fa-wallet', 'route' => 'tour_driver.transport-travel.earnings'],
            ['label' => 'Notifications', 'icon' => 'fas fa-bell', 'route' => 'tour_driver.transport-travel.notifications'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'tour_driver.transport-travel.profile'],
        ],
        'delivery_driver' => [
            ['label' => 'Delivery Home', 'icon' => 'fas fa-truck-loading', 'route' => 'delivery_driver.transport-travel.index'],
            ['label' => 'My Orders', 'icon' => 'fas fa-shopping-cart', 'route' => 'delivery_driver.transport-travel.orders'],
            ['label' => 'Route Map', 'icon' => 'fas fa-map', 'route' => 'delivery_driver.transport-travel.map'],
            ['label' => 'Earnings', 'icon' => 'fas fa-wallet', 'route' => 'delivery_driver.transport-travel.earnings'],
            ['label' => 'Notifications', 'icon' => 'fas fa-bell', 'route' => 'delivery_driver.transport-travel.notifications'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'delivery_driver.transport-travel.profile'],
        ],

        // --- FOOD & FASHION ROLES ---
        'food_vendor' => [
            ['label' => 'Kitchen Dash', 'icon' => 'fas fa-utensils', 'route' => 'food_vendor.index'],
            ['label' => 'My Menu', 'icon' => 'fas fa-book-open', 'route' => 'marketplace.index'],
        ],
        'fashion_vendor' => [
            ['label' => 'Fashion Atelier', 'icon' => 'fas fa-cut', 'route' => 'fashion_vendor.index'],
            ['label' => 'My Collection', 'icon' => 'fas fa-tshirt', 'route' => 'marketplace.index'],
        ],
        'food_delivery' => [
            ['label' => 'Delivery Hub', 'icon' => 'fas fa-motorcycle', 'route' => 'food_delivery.index'],
        ],

        // --- OTHER ROLES ---
        'gym_trainer' => [['label' => 'Gym Coach', 'icon' => 'fas fa-dumbbell', 'route' => 'gym_trainer.index']],
        'yoga_trainer' => [['label' => 'Yoga Master', 'icon' => 'fas fa-spa', 'route' => 'yoga_trainer.index']],
        'fitness_coach' => [['label' => 'Fitness Pro', 'icon' => 'fas fa-heartbeat', 'route' => 'fitness_coach.index']],
        'student' => [['label' => 'Student Portal', 'icon' => 'fas fa-user-graduate', 'route' => 'student.index']],
        'teacher' => [['label' => 'Teacher Desk', 'icon' => 'fas fa-chalkboard-teacher', 'route' => 'teacher.index']],
        'tutor' => [['label' => 'Tutor Hub', 'icon' => 'fas fa-chalkboard', 'route' => 'tutor.index']],
        'farmer' => [['label' => 'Farm Manager', 'icon' => 'fas fa-tractor', 'route' => 'farmer.index']],
        'input_supplier' => [['label' => 'Supplier Hub', 'icon' => 'fas fa-seedling', 'route' => 'input_supplier.index']],
        'media_creator' => [['label' => 'Creator Studio', 'icon' => 'fas fa-video', 'route' => 'media_creator.index']],
        'media_producer' => [['label' => 'Producer Table', 'icon' => 'fas fa-film', 'route' => 'media_producer.index']],
        'legal_pro' => [['label' => 'Legal Suite', 'icon' => 'fas fa-gavel', 'route' => 'legal_pro.index']],
        'professional_consultant' => [['label' => 'Consultancy', 'icon' => 'fas fa-briefcase', 'route' => 'professional_consultant.index']],

        // --- SPECIAL TRANSPORT ---
        'ambulance_driver' => [
            ['label' => 'Ambulance Dash', 'icon' => 'fas fa-ambulance', 'route' => 'ambulance_driver.transport-travel.index'],
            ['label' => 'Dispatches', 'icon' => 'fas fa-headset', 'route' => 'ambulance_driver.transport-travel.dispatches'],
            ['label' => 'Patients', 'icon' => 'fas fa-procedures', 'route' => 'ambulance_driver.transport-travel.patients'],
            ['label' => 'Equipment', 'icon' => 'fas fa-medkit', 'route' => 'ambulance_driver.transport-travel.equipment'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-md', 'route' => 'ambulance_driver.transport-travel.profile'],
        ],
        'special_needs_transport' => [
            ['label' => 'Accessibility Dash', 'icon' => 'fas fa-wheelchair', 'route' => 'special_needs_transport.transport-travel.index'],
            ['label' => 'My Schedules', 'icon' => 'fas fa-calendar-alt', 'route' => 'special_needs_transport.transport-travel.schedules'],
            ['label' => 'Access Logs', 'icon' => 'fas fa-clipboard-check', 'route' => 'special_needs_transport.transport-travel.logs'],
            ['label' => 'Vehicle Check', 'icon' => 'fas fa-check-double', 'route' => 'special_needs_transport.transport-travel.vehicle'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'special_needs_transport.transport-travel.profile'],
        ],
        'vip_executive_driver' => [
            ['label' => 'VIP Concierge', 'icon' => 'fas fa-gem', 'route' => 'vip_executive_driver.transport-travel.index'],
            ['label' => 'Reservations', 'icon' => 'fas fa-bookmark', 'route' => 'vip_executive_driver.transport-travel.reservations'],
            ['label' => 'Client Prefs', 'icon' => 'fas fa-user-tag', 'route' => 'vip_executive_driver.transport-travel.clients'],
            ['label' => 'Amenities', 'icon' => 'fas fa-wine-glass-alt', 'route' => 'vip_executive_driver.transport-travel.vehicle'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-tie', 'route' => 'vip_executive_driver.transport-travel.profile'],
        ],

        // --- SUPPORT PROVIDERS ---
        'vehicle_servicing' => [
            ['label' => 'Service Bay', 'icon' => 'fas fa-wrench', 'route' => 'vehicle_servicing.transport-travel.index'],
            ['label' => 'Active Jobs', 'icon' => 'fas fa-tasks', 'route' => 'vehicle_servicing.transport-travel.jobs'],
            ['label' => 'Inspections', 'icon' => 'fas fa-search', 'route' => 'vehicle_servicing.transport-travel.inspections'],
            ['label' => 'Inventory', 'icon' => 'fas fa-boxes', 'route' => 'vehicle_servicing.transport-travel.inventory'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-cog', 'route' => 'vehicle_servicing.transport-travel.profile'],
        ],
        'customer_care' => [
            ['label' => 'Support Desk', 'icon' => 'fas fa-headset', 'route' => 'customer_care.transport-travel.index'],
            ['label' => 'Support Tickets', 'icon' => 'fas fa-ticket-alt', 'route' => 'customer_care.transport-travel.tickets'],
            ['label' => 'Live Chat', 'icon' => 'fas fa-comments', 'route' => 'customer_care.transport-travel.chat'],
            ['label' => 'Feedback', 'icon' => 'fas fa-star', 'route' => 'customer_care.transport-travel.feedback'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'customer_care.transport-travel.profile'],
        ],
        'roadside_assistance' => [
            ['label' => 'Rescue Dash', 'icon' => 'fas fa-truck-pickup', 'route' => 'roadside_assistance.transport-travel.index'],
            ['label' => 'SOS Calls', 'icon' => 'fas fa-phone-volume', 'route' => 'roadside_assistance.transport-travel.sos'],
            ['label' => 'Active Dispatches', 'icon' => 'fas fa-map-marker-alt', 'route' => 'roadside_assistance.transport-travel.dispatches'],
            ['label' => 'Tow Truck', 'icon' => 'fas fa-truck', 'route' => 'roadside_assistance.transport-travel.vehicle'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-hard-hat', 'route' => 'roadside_assistance.transport-travel.profile'],
        ],
        'safety_compliance' => [
            ['label' => 'Safety HQ', 'icon' => 'fas fa-shield-alt', 'route' => 'safety_compliance.transport-travel.index'],
            ['label' => 'Safety Audits', 'icon' => 'fas fa-clipboard-check', 'route' => 'safety_compliance.transport-travel.audits'],
            ['label' => 'Incidents', 'icon' => 'fas fa-exclamation-triangle', 'route' => 'safety_compliance.transport-travel.incidents'],
            ['label' => 'Training', 'icon' => 'fas fa-chalkboard-teacher', 'route' => 'safety_compliance.transport-travel.training'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-shield', 'route' => 'safety_compliance.transport-travel.profile'],
        ],

        // --- BUSINESS & SPECIAL ROLES ---
        'businessperson' => [
            ['label' => 'Business Hub', 'icon' => 'fas fa-briefcase', 'route' => 'businessperson.transport-travel.index'],
            ['label' => 'Fleet Manager', 'icon' => 'fas fa-truck-moving', 'route' => 'businessperson.transport-travel.fleet'],
            ['label' => 'Financials', 'icon' => 'fas fa-chart-line', 'route' => 'businessperson.transport-travel.financials'],
            ['label' => 'Employees', 'icon' => 'fas fa-users', 'route' => 'businessperson.transport-travel.employees'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-tie', 'route' => 'businessperson.transport-travel.profile'],
        ],
        'mediator' => [
            ['label' => 'Mediation Room', 'icon' => 'fas fa-balance-scale', 'route' => 'mediator.transport-travel.index'],
            ['label' => 'Active Cases', 'icon' => 'fas fa-gavel', 'route' => 'mediator.transport-travel.cases'],
            ['label' => 'Dispute Log', 'icon' => 'fas fa-file-contract', 'route' => 'mediator.transport-travel.disputes'],
            ['label' => 'Calendar', 'icon' => 'fas fa-calendar-alt', 'route' => 'mediator.transport-travel.calendar'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'mediator.transport-travel.profile'],
        ],
        'moderator' => [
            ['label' => 'Mod Control', 'icon' => 'fas fa-user-shield', 'route' => 'moderator.transport-travel.index'],
            ['label' => 'Content Review', 'icon' => 'fas fa-search', 'route' => 'moderator.transport-travel.review'],
            ['label' => 'User Flags', 'icon' => 'fas fa-flag', 'route' => 'moderator.transport-travel.flags'],
            ['label' => 'System Reports', 'icon' => 'fas fa-file-alt', 'route' => 'moderator.transport-travel.reports'],
            ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'moderator.transport-travel.profile'],
        ],

        // --- FOOD, EVENTS & FASHION ROLES ---
        'event_coordinator' => [
            ['label' => 'Event Command', 'icon' => 'fas fa-calendar-check', 'route' => 'event_coordinator.food-events-fashion.index'],
            ['label' => 'My Events', 'icon' => 'fas fa-clipboard-list', 'route' => 'event_coordinator.food-events-fashion.events'],
            ['label' => 'Clients', 'icon' => 'fas fa-users', 'route' => 'event_coordinator.food-events-fashion.clients'],
            ['label' => 'Vendors', 'icon' => 'fas fa-store', 'route' => 'event_coordinator.food-events-fashion.vendors'],
        ],
        'wedding_planner' => [
            ['label' => 'Wedding Hub', 'icon' => 'fas fa-dove', 'route' => 'wedding_planner.food-events-fashion.index'],
            ['label' => 'Weddings', 'icon' => 'fas fa-rings-wedding', 'route' => 'wedding_planner.food-events-fashion.weddings'],
            ['label' => 'Couples', 'icon' => 'fas fa-heart', 'route' => 'wedding_planner.food-events-fashion.couples'],
            ['label' => 'Timeline', 'icon' => 'fas fa-clock', 'route' => 'wedding_planner.food-events-fashion.timeline'],
        ],
        'corporate_event_organizer' => [
            ['label' => 'Corporate Ops', 'icon' => 'fas fa-building', 'route' => 'corporate_event.food-events-fashion.index'],
            ['label' => 'Conferences', 'icon' => 'fas fa-handshake', 'route' => 'corporate_event.food-events-fashion.conferences'],
        ],
        'decorator_event_stylist' => [
            ['label' => 'Design Studio', 'icon' => 'fas fa-paint-brush', 'route' => 'decorator.food-events-fashion.index'],
            ['label' => 'Themes', 'icon' => 'fas fa-palette', 'route' => 'decorator.food-events-fashion.themes'],
            ['label' => 'Inventory', 'icon' => 'fas fa-couch', 'route' => 'decorator.food-events-fashion.inventory'],
        ],
        'photographer_videographer' => [
            ['label' => 'Photo Studio', 'icon' => 'fas fa-camera-retro', 'route' => 'photographer.food-events-fashion.index'],
            ['label' => 'Shoot Schedule', 'icon' => 'fas fa-calendar-day', 'route' => 'photographer.food-events-fashion.shoots'],
            ['label' => 'Visual Gallery', 'icon' => 'fas fa-images', 'route' => 'photographer.food-events-fashion.gallery'],
        ],
        'catering_services' => [
            ['label' => 'Kitchen Command', 'icon' => 'fas fa-utensils', 'route' => 'catering.food-events-fashion.index'],
            ['label' => 'Active Orders', 'icon' => 'fas fa-receipt', 'route' => 'catering.food-events-fashion.orders'],
            ['label' => 'Menus', 'icon' => 'fas fa-book-open', 'route' => 'catering.food-events-fashion.menus'],
        ],
        'bakery_cake_services' => [
            ['label' => 'Bakery Dash', 'icon' => 'fas fa-birthday-cake', 'route' => 'bakery.food-events-fashion.index'],
            ['label' => 'Cake Orders', 'icon' => 'fas fa-clipboard', 'route' => 'bakery.food-events-fashion.cakes'],
        ],
        'event_clothes_rental' => [
            ['label' => 'Wardrobe', 'icon' => 'fas fa-tshirt', 'route' => 'clothes_rental.food-events-fashion.index'],
        ],
        'post_event_cleanup' => [
            ['label' => 'Cleanup Crew', 'icon' => 'fas fa-broom', 'route' => 'cleanup.food-events-fashion.index'],
            ['label' => 'Job Queue', 'icon' => 'fas fa-clipboard-check', 'route' => 'cleanup.food-events-fashion.jobs'],
        ],
        'birthday_party_organizer' => [
            ['label' => 'Party Central', 'icon' => 'fas fa-birthday-cake', 'route' => 'birthday_organizer.food-events-fashion.index'],
        ],
        'conference_seminar_organizer' => [
            ['label' => 'Seminar Ops', 'icon' => 'fas fa-chalkboard-teacher', 'route' => 'conference_organizer.food-events-fashion.index'],
        ],
        'exhibition_trade_fair_organizer' => [
            ['label' => 'Expo Hub', 'icon' => 'fas fa-store-alt', 'route' => 'exhibition_organizer.food-events-fashion.index'],
        ],
        'lighting_sound_technician' => [
            ['label' => 'Tech Booth', 'icon' => 'fas fa-sliders-h', 'route' => 'lighting_sound.food-events-fashion.index'],
        ],
        'stage_av_setup' => [
            ['label' => 'Stage Crew', 'icon' => 'fas fa-layer-group', 'route' => 'stage_av.food-events-fashion.index'],
        ],
        'mc_host_entertainer' => [
            ['label' => 'Green Room', 'icon' => 'fas fa-microphone-alt', 'route' => 'mc_host.food-events-fashion.index'],
        ],
        'music_dj_services' => [
            ['label' => 'DJ Deck', 'icon' => 'fas fa-compact-disc', 'route' => 'music_dj.food-events-fashion.index'],
        ],
        'beverage_services' => [
            ['label' => 'Bar Manager', 'icon' => 'fas fa-glass-martini-alt', 'route' => 'beverage.food-events-fashion.index'],
        ],
        'other_food_services' => [
            ['label' => 'Specialty Food', 'icon' => 'fas fa-utensils', 'route' => 'other_food.food-events-fashion.index'],
        ],
        'event_tailoring' => [
            ['label' => 'Tailor Shop', 'icon' => 'fas fa-cut', 'route' => 'event_tailoring.food-events-fashion.index'],
        ],
        'equipment_maintenance' => [
            ['label' => 'Gear Repair', 'icon' => 'fas fa-tools', 'route' => 'equipment_maintenance.food-events-fashion.index'],
        ],
        'catering_followup' => [
            ['label' => 'Taste Test', 'icon' => 'fas fa-comment-dots', 'route' => 'catering_followup.food-events-fashion.index'],
        ],
        'customer_loyalty' => [
            ['label' => 'Loyalty Prgm', 'icon' => 'fas fa-gem', 'route' => 'customer_loyalty.food-events-fashion.index'],
        ],

        // --- EDUCATION & KNOWLEDGE ROLES ---
        'instructor_teacher' => [
            ['label' => 'Classroom', 'icon' => 'fas fa-chalkboard-teacher', 'route' => 'instructor.education_knowledge.index'],
            ['label' => 'My Classes', 'icon' => 'fas fa-users', 'route' => 'instructor.education_knowledge.classes'],
        ],
        'trainer' => [
            ['label' => 'Training Hub', 'icon' => 'fas fa-dumbbell', 'route' => 'trainer.education_knowledge.index'],
        ],
        'lecturer' => [
            ['label' => 'Lecture Hall', 'icon' => 'fas fa-university', 'route' => 'lecturer.education_knowledge.index'],
        ],
        'tutor_mentor' => [
            ['label' => 'Mentorship', 'icon' => 'fas fa-hands-helping', 'route' => 'tutor.education_knowledge.index'],
        ],
        'educational_content_creator' => [
            ['label' => 'Content Studio', 'icon' => 'fas fa-pencil-ruler', 'route' => 'content_creator.education_knowledge.index'],
        ],
        'curriculum_developer' => [
            ['label' => 'Curriculum lab', 'icon' => 'fas fa-project-diagram', 'route' => 'curriculum_dev.education_knowledge.index'],
        ],
        'knowledge_publisher' => [
            ['label' => 'Press Room', 'icon' => 'fas fa-newspaper', 'route' => 'publisher.education_knowledge.index'],
        ],
        'researcher' => [
            ['label' => 'Research Lab', 'icon' => 'fas fa-flask', 'route' => 'researcher.education_knowledge.index'],
        ],
        'academic_writer' => [
            ['label' => 'Writing Desk', 'icon' => 'fas fa-pen-fancy', 'route' => 'academic_writer.education_knowledge.index'],
        ],
        'academic_advisor' => [
            ['label' => 'Advisory', 'icon' => 'fas fa-user-friends', 'route' => 'academic_advisor.education_knowledge.index'],
        ],
        'career_guidance' => [
            ['label' => 'Career Path', 'icon' => 'fas fa-compass', 'route' => 'career_guidance.education_knowledge.index'],
        ],
        'examiner' => [
            ['label' => 'Exam Hall', 'icon' => 'fas fa-file-signature', 'route' => 'examiner.education_knowledge.index'],
        ],
        'assessor' => [
            ['label' => 'Assessment', 'icon' => 'fas fa-check-double', 'route' => 'assessor.education_knowledge.index'],
        ],
        'quality_assurance' => [
            ['label' => 'QA Dashboard', 'icon' => 'fas fa-clipboard-check', 'route' => 'quality_assurance.education_knowledge.index'],
        ],
        // 'moderator' logic shared, or add specific 'edu_moderator' key if we distinct content
        'school_institution_owner' => [
            ['label' => 'Institution', 'icon' => 'fas fa-school', 'route' => 'school_owner.education_knowledge.index'],
        ],
        'training_center_owner' => [
            ['label' => 'Training Ctr', 'icon' => 'fas fa-building', 'route' => 'training_owner.education_knowledge.index'],
        ],
        'education_business' => [
            ['label' => 'Edu Biz', 'icon' => 'fas fa-briefcase', 'route' => 'edu_business.education_knowledge.index'],
        ],
        'publishing_business' => [
            ['label' => 'Publishing House', 'icon' => 'fas fa-book-open', 'route' => 'publishing_business.education_knowledge.index'],
        ],
        'student_learner' => [
            ['label' => 'My Studies', 'icon' => 'fas fa-user-graduate', 'route' => 'student.education_knowledge.index'],
        ],
        'parent_guardian' => [
            ['label' => 'Guardian Portal', 'icon' => 'fas fa-user-shield', 'route' => 'parent.education_knowledge.index'],
        ],

        // --- AGRICULTURE & ENVIRONMENT ROLES ---
        'crop_farming_followups' => [
            ['label' => 'Crop Monitor', 'icon' => 'fas fa-seedling', 'route' => 'crop_followup.agriculture_environment.index'],
        ],
        'soil_management' => [
            ['label' => 'Soil Health', 'icon' => 'fas fa-layer-group', 'route' => 'soil_mgmt.agriculture_environment.index'],
        ],
        'irrigation_support' => [
            ['label' => 'Irrigation', 'icon' => 'fas fa-water', 'route' => 'irrigation.agriculture_environment.index'],
        ],
        'pest_disease_management' => [
            ['label' => 'Pest Control', 'icon' => 'fas fa-bug', 'route' => 'pest_mgmt.agriculture_environment.index'],
        ],
        'animal_health_veterinary' => [
            ['label' => 'Vet Clinic', 'icon' => 'fas fa-stethoscope', 'route' => 'veterinary.agriculture_environment.index'],
        ],
        'breeding_reproduction' => [
            ['label' => 'Breeding', 'icon' => 'fas fa-dna', 'route' => 'breeder.agriculture_environment.index'],
        ],
        'feed_nutrition_management' => [
            ['label' => 'Nutrition', 'icon' => 'fas fa-apple-alt', 'route' => 'nutritionist.agriculture_environment.index'],
        ],
        'livestock_monitoring' => [
            ['label' => 'Livestock', 'icon' => 'fas fa-horse', 'route' => 'livestock_monitor.agriculture_environment.index'],
        ],
        'fish_farming_services' => [
            ['label' => 'Fish Farm', 'icon' => 'fas fa-fish', 'route' => 'fish_farm.agriculture_environment.index'],
        ],
        'water_quality_management' => [
            ['label' => 'Water Quality', 'icon' => 'fas fa-vial', 'route' => 'water_quality.agriculture_environment.index'],
        ],
        'harvest_processing' => [
            ['label' => 'Harvest', 'icon' => 'fas fa-tractor', 'route' => 'harvest_proc.agriculture_environment.index'],
        ],
        'bee_farming_services' => [
            ['label' => 'Apiary', 'icon' => 'fab fa-first-order-alt', 'route' => 'bee_farm.agriculture_environment.index'], // using generic icon or fa-bug if specific not available free
        ],
        'hive_management' => [
            ['label' => 'Hive Mgmt', 'icon' => 'fas fa-archive', 'route' => 'hive_mgmt.agriculture_environment.index'],
        ],
        'honey_production' => [
            ['label' => 'Honey Prod', 'icon' => 'fas fa-jar', 'route' => 'honey_prod.agriculture_environment.index'],
        ],
        'sustainable_farming' => [
            ['label' => 'Sustainability', 'icon' => 'fas fa-recycle', 'route' => 'sustainable.agriculture_environment.index'],
        ],
        'climate_smart_agriculture' => [
            ['label' => 'Climate Smart', 'icon' => 'fas fa-cloud-sun', 'route' => 'climate_smart.agriculture_environment.index'],
        ],
        'conservation_practices' => [
            ['label' => 'Conservation', 'icon' => 'fas fa-tree', 'route' => 'conservation.agriculture_environment.index'],
        ],
        'farmer_training' => [
            ['label' => 'Training', 'icon' => 'fas fa-chalkboard-teacher', 'route' => 'farmer_train.agriculture_environment.index'],
        ],
        'advisory_consultation' => [
            ['label' => 'Advisory', 'icon' => 'fas fa-comments', 'route' => 'agri_advisor.agriculture_environment.index'],
        ],
        'field_demonstration' => [
            ['label' => 'Field Demo', 'icon' => 'fas fa-map-marked-alt', 'route' => 'field_demo.agriculture_environment.index'],
        ],
        'seeds_fertilizers' => [
            ['label' => 'Inputs', 'icon' => 'fas fa-seedling', 'route' => 'seeds_fert.agriculture_environment.index'],
        ],
        'animal_feed' => [
            ['label' => 'Feed Store', 'icon' => 'fas fa-shopping-basket', 'route' => 'animal_feed.agriculture_environment.index'],
        ],
        'equipment_tools' => [
            ['label' => 'Tools', 'icon' => 'fas fa-wrench', 'route' => 'agri_tools.agriculture_environment.index'],
        ],
        'farm_inspection' => [
            ['label' => 'Inspection', 'icon' => 'fas fa-search', 'route' => 'farm_inspect.agriculture_environment.index'],
        ],
        'data_reporting' => [
            ['label' => 'Reports', 'icon' => 'fas fa-chart-line', 'route' => 'data_report.agriculture_environment.index'],
        ],
        'storage_preservation' => [
            ['label' => 'Storage', 'icon' => 'fas fa-warehouse', 'route' => 'storage.agriculture_environment.index'],
        ],
        'market_linkage' => [
            ['label' => 'Market', 'icon' => 'fas fa-store', 'route' => 'market_link.agriculture_environment.index'],
        ],
        'agribusiness_owner' => [
            ['label' => 'Agri Biz', 'icon' => 'fas fa-briefcase', 'route' => 'agri_biz.agriculture_environment.index'],
        ],
        'farm_owner' => [
            ['label' => 'My Farm', 'icon' => 'fas fa-home', 'route' => 'farm_owner.agriculture_environment.index'],
        ],
        'cooperative_organization' => [
            ['label' => 'Co-op', 'icon' => 'fas fa-users', 'route' => 'coop.agriculture_environment.index'],
        ],
        'input_supply_business' => [
            ['label' => 'Supply Biz', 'icon' => 'fas fa-truck-loading', 'route' => 'input_biz.agriculture_environment.index'],
        ],

        // --- MEDIA & ENTERTAINMENT ---
        'media_consumer' => [['label' => 'Dashboard', 'icon' => 'fas fa-tv', 'route' => 'media_consumer.media-entertainment.index']],
        'media_creator' => [['label' => 'Dashboard', 'icon' => 'fas fa-paint-brush', 'route' => 'media_creator.media-entertainment.index']],
        'media_producer' => [['label' => 'Dashboard', 'icon' => 'fas fa-video', 'route' => 'media_producer.media-entertainment.index']],
        'media_advertiser' => [['label' => 'Dashboard', 'icon' => 'fas fa-ad', 'route' => 'media_advertiser.media-entertainment.index']],
        'media_distributor' => [['label' => 'Dashboard', 'icon' => 'fas fa-share-alt', 'route' => 'media_distributor.media-entertainment.index']],
        'media_admin' => [['label' => 'Dashboard', 'icon' => 'fas fa-user-shield', 'route' => 'media_admin.media-entertainment.index']],

        // --- LEGAL & PROFESSIONAL ---
        'legal_client' => [['label' => 'Dashboard', 'icon' => 'fas fa-user', 'route' => 'legal_client.legal-professional.index']],
        'legal_pro' => [['label' => 'Dashboard', 'icon' => 'fas fa-gavel', 'route' => 'legal_pro.legal-professional.index']],
        'professional_consultant' => [['label' => 'Dashboard', 'icon' => 'fas fa-briefcase', 'route' => 'professional_consultant.legal-professional.index']],
        'legal_firm' => [['label' => 'Dashboard', 'icon' => 'fas fa-building', 'route' => 'legal_firm.legal-professional.index']],
        'legal_regulator' => [['label' => 'Dashboard', 'icon' => 'fas fa-balance-scale', 'route' => 'legal_regulator.legal-professional.index']],
        'legal_admin' => [['label' => 'Dashboard', 'icon' => 'fas fa-user-shield', 'route' => 'legal_admin.legal-professional.index']],
    ]
];
