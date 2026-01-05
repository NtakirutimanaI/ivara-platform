<?php

return [
    'menus' => [
        // --- ADMIN & MANAGEMENT ROLES ---
        'super_admin' => [
            ['label' => 'Super Dash', 'icon' => 'fas fa-user-shield', 'route' => 'super_admin.index'],
            ['label' => 'Credentials', 'icon' => 'fas fa-key', 'route' => 'super_admin.credentials'],
            ['label' => 'Users Control', 'icon' => 'fas fa-users-cog', 'route' => 'admin.users.index'],
            ['label' => 'Permissions', 'icon' => 'fas fa-shield-alt', 'route' => 'admin.roles_permissions'],
            ['label' => 'System Logs', 'icon' => 'fas fa-terminal', 'route' => 'admin.reports'],
        ],
        'admin' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'admin.dashboard.overview'],
                    ['label' => 'Live Map (Branches, Devices, Technicians)', 'icon' => 'fas fa-map-marked', 'route' => 'admin.dashboard.live_map'],
                    ['label' => 'System Alerts', 'icon' => 'fas fa-exclamation-triangle', 'route' => 'admin.dashboard.system_alerts'],
                ],
            ],
            // Devices & Security
            [
                'label' => 'Devices & Security',
                'icon' => 'fas fa-microchip',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Device', 'icon' => 'fas fa-plus', 'route' => 'admin.devices.register'],
                    ['label' => 'All Registered Devices', 'icon' => 'fas fa-list', 'route' => 'admin.devices.all'],
                    ['label' => 'Device Ownership History', 'icon' => 'fas fa-history', 'route' => 'admin.devices.ownership_history'],
                    ['label' => 'Stolen Devices', 'icon' => 'fas fa-user-secret', 'route' => 'admin.devices.stolen'],
                    ['label' => 'Recovered Devices', 'icon' => 'fas fa-undo', 'route' => 'admin.devices.recovered'],
                    ['label' => 'Device Tracking (Map)', 'icon' => 'fas fa-map', 'route' => 'admin.devices.tracking'],
                    ['label' => 'Blocked / Blacklisted Devices', 'icon' => 'fas fa-ban', 'route' => 'admin.devices.blocked'],
                    ['label' => 'QR / Serial Verification', 'icon' => 'fas fa-qrcode', 'route' => 'admin.devices.qr_verify'],
                ],
            ],
            // Repairs Management
            [
                'label' => 'Repairs Management',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'All Repairs', 'icon' => 'fas fa-list', 'route' => 'admin.repairs.all'],
                    ['label' => 'Repair Requests', 'icon' => 'fas fa-tools', 'route' => 'admin.repairs.requests'],
                    ['label' => 'Assign Technicians', 'icon' => 'fas fa-user-cog', 'route' => 'admin.repairs.assign_technicians'],
                    ['label' => 'Repair Progress', 'icon' => 'fas fa-tasks', 'route' => 'admin.repairs.progress'],
                    ['label' => 'Completed Repairs', 'icon' => 'fas fa-check-double', 'route' => 'admin.repairs.completed'],
                    ['label' => 'Repair History', 'icon' => 'fas fa-history', 'route' => 'admin.repairs.history'],
                    ['label' => 'Warranty & Service Records', 'icon' => 'fas fa-shield-alt', 'route' => 'admin.repairs.warranty'],
                ],
            ],
            // Products & Spare Parts
            [
                'label' => 'Products & Spare Parts',
                'icon' => 'fas fa-box-open',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Imported Products', 'icon' => 'fas fa-box', 'route' => 'admin.products.imported'],
                    ['label' => 'Spare Parts Inventory', 'icon' => 'fas fa-cogs', 'route' => 'admin.spare_parts.inventory'],
                    ['label' => 'Stock Levels', 'icon' => 'fas fa-warehouse', 'route' => 'admin.stock.levels'],
                    ['label' => 'Product Pricing', 'icon' => 'fas fa-tag', 'route' => 'admin.products.pricing'],
                    ['label' => 'Suppliers & Imports', 'icon' => 'fas fa-truck', 'route' => 'admin.suppliers.imports'],
                    ['label' => 'Damaged / Returned Items', 'icon' => 'fas fa-undo', 'route' => 'admin.products.damaged'],
                ],
            ],
            // Marketplace
            [
                'label' => 'Marketplace',
                'icon' => 'fas fa-store',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Marketplace Products', 'icon' => 'fas fa-box', 'route' => 'admin.marketplace.products'],
                    ['label' => 'Marketplace Services', 'icon' => 'fas fa-concierge-bell', 'route' => 'admin.marketplace.services'],
                    ['label' => 'Orders', 'icon' => 'fas fa-receipt', 'route' => 'admin.marketplace.orders'],
                    ['label' => 'Returns & Refunds', 'icon' => 'fas fa-undo', 'route' => 'admin.marketplace.returns'],
                    ['label' => 'Featured Listings', 'icon' => 'fas fa-star', 'route' => 'admin.marketplace.featured'],
                ],
            ],
            // Branches & Operations
            [
                'label' => 'Branches & Operations',
                'icon' => 'fas fa-sitemap',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Branches', 'icon' => 'fas fa-building', 'route' => 'admin.branches.index'],
                    ['label' => 'Branch Performance', 'icon' => 'fas fa-chart-line', 'route' => 'admin.branches.performance'],
                    ['label' => 'Branch Inventory', 'icon' => 'fas fa-boxes', 'route' => 'admin.branches.inventory'],
                    ['label' => 'Service Zones (Map)', 'icon' => 'fas fa-map-marked-alt', 'route' => 'admin.branches.service_zones'],
                ],
            ],
            // Staff & Users
            [
                'label' => 'Staff & Users',
                'icon' => 'fas fa-users-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Admins', 'icon' => 'fas fa-user-shield', 'route' => 'admin.staff.admins'],
                    ['label' => 'Managers', 'icon' => 'fas fa-user-tie', 'route' => 'admin.staff.managers'],
                    ['label' => 'Supervisors', 'icon' => 'fas fa-user-secret', 'route' => 'admin.staff.supervisors'],
                    ['label' => 'Technicians', 'icon' => 'fas fa-user-cog', 'route' => 'admin.staff.technicians'],
                    ['label' => 'Mechanics', 'icon' => 'fas fa-car-mechanic', 'route' => 'admin.staff.mechanics'],
                    ['label' => 'Electricians', 'icon' => 'fas fa-bolt', 'route' => 'admin.staff.electricians'],
                    ['label' => 'Craftspersons', 'icon' => 'fas fa-hammer', 'route' => 'admin.staff.craftspersons'],
                    ['label' => 'Tailors', 'icon' => 'fas fa-cut', 'route' => 'admin.staff.tailors'],
                    ['label' => 'Builders', 'icon' => 'fas fa-hard-hat', 'route' => 'admin.staff.builders'],
                    ['label' => 'Business Accounts', 'icon' => 'fas fa-briefcase', 'route' => 'admin.staff.business_accounts'],
                    ['label' => 'Clients', 'icon' => 'fas fa-user-friends', 'route' => 'admin.staff.clients'],
                ],
            ],
            // Subscriptions & Revenue
            [
                'label' => 'Subscriptions & Revenue',
                'icon' => 'fas fa-dollar-sign',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Business Subscriptions', 'icon' => 'fas fa-id-card', 'route' => 'admin.subscriptions.business'],
                    ['label' => 'Subscription Plans', 'icon' => 'fas fa-list', 'route' => 'admin.subscriptions.plans'],
                    ['label' => 'Commissions', 'icon' => 'fas fa-percentage', 'route' => 'admin.revenue.commissions'],
                    ['label' => 'Platform Revenue', 'icon' => 'fas fa-chart-pie', 'route' => 'admin.revenue.platform'],
                    ['label' => 'Payouts', 'icon' => 'fas fa-hand-holding-usd', 'route' => 'admin.revenue.payouts'],
                ],
            ],
            // Reports & Analytics
            [
                'label' => 'Reports & Analytics',
                'icon' => 'fas fa-chart-bar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Sales Reports', 'icon' => 'fas fa-chart-line', 'route' => 'admin.reports.sales'],
                    ['label' => 'Repair Reports', 'icon' => 'fas fa-wrench', 'route' => 'admin.reports.repairs'],
                    ['label' => 'Device Reports', 'icon' => 'fas fa-microchip', 'route' => 'admin.reports.devices'],
                    ['label' => 'Theft & Recovery Reports', 'icon' => 'fas fa-theft', 'route' => 'admin.reports.theft'],
                    ['label' => 'Technician Performance', 'icon' => 'fas fa-user-check', 'route' => 'admin.reports.technician_performance'],
                    ['label' => 'Branch Reports', 'icon' => 'fas fa-sitemap', 'route' => 'admin.reports.branch'],
                    ['label' => 'Financial Reports', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'admin.reports.financial'],
                ],
            ],
            // Invoices & Payments
            [
                'label' => 'Invoices & Payments',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Sales Invoices', 'icon' => 'fas fa-file-invoice', 'route' => 'admin.invoices.sales'],
                    ['label' => 'Repair Invoices', 'icon' => 'fas fa-tools', 'route' => 'admin.invoices.repairs'],
                    ['label' => 'Payments', 'icon' => 'fas fa-credit-card', 'route' => 'admin.payments'],
                    ['label' => 'Refunds', 'icon' => 'fas fa-undo', 'route' => 'admin.refunds'],
                ],
            ],
            // Notifications & Logs
            [
                'label' => 'Notifications & Logs',
                'icon' => 'fas fa-bell',
                'dropdown' => true,
                'items' => [
                    ['label' => 'System Notifications', 'icon' => 'fas fa-bell', 'route' => 'admin.notifications.system'],
                    ['label' => 'Activity Logs', 'icon' => 'fas fa-clipboard-list', 'route' => 'admin.logs.activity'],
                    ['label' => 'Audit Logs', 'icon' => 'fas fa-search', 'route' => 'admin.logs.audit'],
                ],
            ],
            // Settings
            [
                'label' => 'Settings',
                'icon' => 'fas fa-sliders-h',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Category Settings', 'icon' => 'fas fa-cog', 'route' => 'admin.settings.category'],
                    ['label' => 'Roles & Permissions', 'icon' => 'fas fa-shield-alt', 'route' => 'admin.settings.roles_permissions'],
                    ['label' => 'Notification Rules', 'icon' => 'fas fa-bell', 'route' => 'admin.settings.notification_rules'],
                    ['label' => 'Security Settings', 'icon' => 'fas fa-lock', 'route' => 'admin.settings.security'],
                    ['label' => 'API & Integrations', 'icon' => 'fas fa-plug', 'route' => 'admin.settings.api_integrations'],
                ],
            ],
        ],
        'manager' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'manager.dashboard.overview'],
                    ['label' => 'Branch Map', 'icon' => 'fas fa-map-marked', 'route' => 'manager.dashboard.branch_map'],
                    ['label' => "Today’s Activities", 'icon' => 'fas fa-calendar-day', 'route' => 'manager.dashboard.todays_activities'],
                ],
            ],
            // Devices
            [
                'label' => 'Devices',
                'icon' => 'fas fa-microchip',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Device', 'icon' => 'fas fa-plus', 'route' => 'manager.devices.register'],
                    ['label' => 'Branch Devices', 'icon' => 'fas fa-building', 'route' => 'manager.devices.branch'],
                    ['label' => 'Device Verification', 'icon' => 'fas fa-check', 'route' => 'manager.devices.verify'],
                    ['label' => 'Stolen Devices (View Only)', 'icon' => 'fas fa-user-secret', 'route' => 'manager.devices.stolen'],
                ],
            ],
            // Repairs
            [
                'label' => 'Repairs',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Repair Requests', 'icon' => 'fas fa-tools', 'route' => 'manager.repairs.requests'],
                    ['label' => 'Assign Technicians', 'icon' => 'fas fa-user-cog', 'route' => 'manager.repairs.assign_technicians'],
                    ['label' => 'Repair Progress', 'icon' => 'fas fa-tasks', 'route' => 'manager.repairs.progress'],
                    ['label' => 'Completed Repairs', 'icon' => 'fas fa-check-double', 'route' => 'manager.repairs.completed'],
                    ['label' => 'Warranty Records', 'icon' => 'fas fa-shield-alt', 'route' => 'manager.repairs.warranty'],
                ],
            ],
            // Products & Inventory
            [
                'label' => 'Products & Inventory',
                'icon' => 'fas fa-box-open',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Products', 'icon' => 'fas fa-box', 'route' => 'manager.products.index'],
                    ['label' => 'Spare Parts', 'icon' => 'fas fa-cogs', 'route' => 'manager.spare_parts.index'],
                    ['label' => 'Stock Monitoring', 'icon' => 'fas fa-warehouse', 'route' => 'manager.stock.monitor'],
                    ['label' => 'Reorder Requests', 'icon' => 'fas fa-sync', 'route' => 'manager.stock.reorder'],
                ],
            ],
            // Marketplace
            [
                'label' => 'Marketplace',
                'icon' => 'fas fa-store',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Products', 'icon' => 'fas fa-box', 'route' => 'manager.marketplace.products'],
                    ['label' => 'Orders', 'icon' => 'fas fa-receipt', 'route' => 'manager.marketplace.orders'],
                    ['label' => 'Returns', 'icon' => 'fas fa-undo', 'route' => 'manager.marketplace.returns'],
                ],
            ],
            // Branches
            [
                'label' => 'Branches',
                'icon' => 'fas fa-sitemap',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Branches', 'icon' => 'fas fa-warehouse', 'route' => 'manager.branches.my'],
                    ['label' => 'Branch Staff', 'icon' => 'fas fa-users', 'route' => 'manager.branches.staff'],
                    ['label' => 'Branch Inventory', 'icon' => 'fas fa-boxes', 'route' => 'manager.branches.inventory'],
                    ['label' => 'Branch Performance', 'icon' => 'fas fa-chart-line', 'route' => 'manager.branches.performance'],
                ],
            ],
            // Staff Management
            [
                'label' => 'Staff Management',
                'icon' => 'fas fa-users-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Technicians', 'icon' => 'fas fa-user-cog', 'route' => 'manager.staff.technicians'],
                    ['label' => 'Mechanics', 'icon' => 'fas fa-car-mechanic', 'route' => 'manager.staff.mechanics'],
                    ['label' => 'Electricians', 'icon' => 'fas fa-bolt', 'route' => 'manager.staff.electricians'],
                    ['label' => 'Craftspersons', 'icon' => 'fas fa-hammer', 'route' => 'manager.staff.craftspersons'],
                    ['label' => 'Tailors', 'icon' => 'fas fa-cut', 'route' => 'manager.staff.tailors'],
                    ['label' => 'Builders', 'icon' => 'fas fa-hard-hat', 'route' => 'manager.staff.builders'],
                    ['label' => 'Attendance', 'icon' => 'fas fa-calendar-check', 'route' => 'manager.staff.attendance'],
                    ['label' => 'Performance', 'icon' => 'fas fa-star', 'route' => 'manager.staff.performance'],
                ],
            ],
            // Reports
            [
                'label' => 'Reports',
                'icon' => 'fas fa-file-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Sales Reports', 'icon' => 'fas fa-chart-line', 'route' => 'manager.reports.sales'],
                    ['label' => 'Repair Reports', 'icon' => 'fas fa-wrench', 'route' => 'manager.reports.repairs'],
                    ['label' => 'Inventory Reports', 'icon' => 'fas fa-warehouse', 'route' => 'manager.reports.inventory'],
                    ['label' => 'Branch Reports', 'icon' => 'fas fa-branch', 'route' => 'manager.reports.branch'],
                ],
            ],
            // Invoices & Payments
            [
                'label' => 'Invoices & Payments',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Generate Invoice', 'icon' => 'fas fa-file-invoice', 'route' => 'manager.invoices.generate'],
                    ['label' => 'View Invoices', 'icon' => 'fas fa-eye', 'route' => 'manager.invoices.view'],
                    ['label' => 'Payments', 'icon' => 'fas fa-credit-card', 'route' => 'manager.payments'],
                ],
            ],
            // Notifications
            [
                'label' => 'Notifications',
                'icon' => 'fas fa-bell',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Alerts', 'icon' => 'fas fa-exclamation-circle', 'route' => 'manager.notifications.alerts'],
                    ['label' => 'Messages', 'icon' => 'fas fa-envelope', 'route' => 'manager.notifications.messages'],
                ],
            ],
            // Settings
            [
                'label' => 'Settings',
                'icon' => 'fas fa-sliders-h',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Branch Settings', 'icon' => 'fas fa-cog', 'route' => 'manager.settings.branch'],
                    ['label' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => 'profile.show'],
                ],
            ],
        ],

        'supervisor' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'supervisor.dashboard.overview'],
                    ['label' => 'Assigned Branch Map', 'icon' => 'fas fa-map-marked', 'route' => 'supervisor.dashboard.branch_map'],
                    ['label' => 'Live Repair Status', 'icon' => 'fas fa-tools', 'route' => 'supervisor.dashboard.live_status'],
                ],
            ],
            // Devices
            [
                'label' => 'Devices',
                'icon' => 'fas fa-microchip',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Device', 'icon' => 'fas fa-plus', 'route' => 'supervisor.devices.register'],
                    ['label' => 'Verify Device', 'icon' => 'fas fa-check', 'route' => 'supervisor.devices.verify'],
                    ['label' => 'Device Status', 'icon' => 'fas fa-info-circle', 'route' => 'supervisor.devices.status'],
                ],
            ],
            // Repairs
            [
                'label' => 'Repairs',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Repairs', 'icon' => 'fas fa-clipboard-list', 'route' => 'supervisor.repairs.assigned'],
                    ['label' => 'Monitor Repair Progress', 'icon' => 'fas fa-tasks', 'route' => 'supervisor.repairs.monitor'],
                    ['label' => 'Approve Completed Repairs', 'icon' => 'fas fa-check-double', 'route' => 'supervisor.repairs.approve'],
                    ['label' => 'Repair Issues', 'icon' => 'fas fa-exclamation-triangle', 'route' => 'supervisor.repairs.issues'],
                ],
            ],
            // Products & Spare Parts
            [
                'label' => 'Products & Spare Parts',
                'icon' => 'fas fa-box-open',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Spare Parts Availability', 'icon' => 'fas fa-warehouse', 'route' => 'supervisor.spare_parts.availability'],
                    ['label' => 'Issue Spare Parts', 'icon' => 'fas fa-hand-holding', 'route' => 'supervisor.spare_parts.issue'],
                    ['label' => 'Damaged Parts', 'icon' => 'fas fa-tools', 'route' => 'supervisor.spare_parts.damaged'],
                ],
            ],
            // Staff Supervision
            [
                'label' => 'Staff Supervision',
                'icon' => 'fas fa-users-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Technicians', 'icon' => 'fas fa-user-cog', 'route' => 'supervisor.staff.technicians'],
                    ['label' => 'Mechanics', 'icon' => 'fas fa-car-mechanic', 'route' => 'supervisor.staff.mechanics'],
                    ['label' => 'Electricians', 'icon' => 'fas fa-bolt', 'route' => 'supervisor.staff.electricians'],
                    ['label' => 'Craftspersons', 'icon' => 'fas fa-hammer', 'route' => 'supervisor.staff.craftspersons'],
                    ['label' => 'Tailors', 'icon' => 'fas fa-cut', 'route' => 'supervisor.staff.tailors'],
                    ['label' => 'Builders', 'icon' => 'fas fa-hard-hat', 'route' => 'supervisor.staff.builders'],
                    ['label' => 'Task Assignments', 'icon' => 'fas fa-tasks', 'route' => 'supervisor.staff.task_assignments'],
                ],
            ],
            // Clients
            [
                'label' => 'Clients',
                'icon' => 'fas fa-user-friends',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Client Repair Requests', 'icon' => 'fas fa-wrench', 'route' => 'supervisor.clients.repair_requests'],
                    ['label' => 'Client Complaints', 'icon' => 'fas fa-comment-dots', 'route' => 'supervisor.clients.complaints'],
                ],
            ],
            // Reports
            [
                'label' => 'Reports',
                'icon' => 'fas fa-file-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Daily Repair Report', 'icon' => 'fas fa-calendar-day', 'route' => 'supervisor.reports.daily'],
                    ['label' => 'Technician Activity Report', 'icon' => 'fas fa-user-clock', 'route' => 'supervisor.reports.tech_activity'],
                    ['label' => 'Branch Summary', 'icon' => 'fas fa-branch', 'route' => 'supervisor.reports.branch_summary'],
                ],
            ],
            // Notifications
            [
                'label' => 'Notifications',
                'icon' => 'fas fa-bell',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Alerts', 'icon' => 'fas fa-exclamation-circle', 'route' => 'supervisor.notifications.alerts'],
                    ['label' => 'Messages', 'icon' => 'fas fa-envelope', 'route' => 'supervisor.notifications.messages'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-circle',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-id-badge', 'route' => 'profile.show'],
                ],
            ],
        ],

        // --- TECHNICAL & REPAIR ROLES (Expanded) ---
        'technician' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'technician.dashboard.overview'],
                    ['label' => 'Assigned Jobs Map', 'icon' => 'fas fa-map-marked', 'route' => 'technician.dashboard.map'],
                    ['label' => 'Notifications', 'icon' => 'fas fa-bell', 'route' => 'technician.dashboard.notifications'],
                ],
            ],
            // Repairs
            [
                'label' => 'Repairs',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Repairs', 'icon' => 'fas fa-clipboard-list', 'route' => 'technician.repairs.assigned'],
                    ['label' => 'Start Repair', 'icon' => 'fas fa-play', 'route' => 'technician.repairs.start'],
                    ['label' => 'Update Repair Status', 'icon' => 'fas fa-sync', 'route' => 'technician.repairs.update_status'],
                    ['label' => 'Upload Repair Evidence', 'icon' => 'fas fa-upload', 'route' => 'technician.repairs.evidence'],
                    ['label' => 'Completed Repairs', 'icon' => 'fas fa-check-circle', 'route' => 'technician.repairs.completed'],
                    ['label' => 'Repair History', 'icon' => 'fas fa-history', 'route' => 'technician.repairs.history'],
                ],
            ],
            // Devices
            [
                'label' => 'Devices',
                'icon' => 'fas fa-microchip',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Scan / Verify Device', 'icon' => 'fas fa-qrcode', 'route' => 'technician.devices.scan'],
                    ['label' => 'Register Device', 'icon' => 'fas fa-plus', 'route' => 'technician.devices.register'],
                    ['label' => 'Device Status', 'icon' => 'fas fa-info-circle', 'route' => 'technician.devices.status'],
                ],
            ],
            // Spare Parts
            [
                'label' => 'Spare Parts',
                'icon' => 'fas fa-cogs',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Spare Parts', 'icon' => 'fas fa-hand-holding', 'route' => 'technician.parts.request'],
                    ['label' => 'Used Spare Parts', 'icon' => 'fas fa-recycle', 'route' => 'technician.parts.used'],
                    ['label' => 'Return Damaged Parts', 'icon' => 'fas fa-undo', 'route' => 'technician.parts.return'],
                ],
            ],
            // Clients
            [
                'label' => 'Clients',
                'icon' => 'fas fa-user-friends',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Clients', 'icon' => 'fas fa-user-tag', 'route' => 'technician.clients.assigned'],
                    ['label' => 'Repair Communication', 'icon' => 'fas fa-comments', 'route' => 'technician.clients.communication'],
                ],
            ],
            // Earnings
            [
                'label' => 'Earnings',
                'icon' => 'fas fa-wallet',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Earnings', 'icon' => 'fas fa-dollar-sign', 'route' => 'technician.earnings.my_earnings'],
                    ['label' => 'Completed Jobs Payments', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'technician.earnings.payments'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-id-badge',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-user', 'route' => 'technician.profile.view'],
                    ['label' => 'Availability Status', 'icon' => 'fas fa-toggle-on', 'route' => 'technician.profile.availability'],
                ],
            ],
        ],
        'mechanic' => [ // Mechanician
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'mechanic.dashboard.overview'],
                    ['label' => 'Mechanical Jobs Map', 'icon' => 'fas fa-map-marked-alt', 'route' => 'mechanic.dashboard.map'],
                ],
            ],
            // Repairs
            [
                'label' => 'Repairs',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Mechanical Repairs', 'icon' => 'fas fa-clipboard-list', 'route' => 'mechanic.repairs.assigned'],
                    ['label' => 'Update Repair Status', 'icon' => 'fas fa-sync', 'route' => 'mechanic.repairs.update_status'],
                    ['label' => 'Completed Repairs', 'icon' => 'fas fa-check-circle', 'route' => 'mechanic.repairs.completed'],
                    ['label' => 'Repair History', 'icon' => 'fas fa-history', 'route' => 'mechanic.repairs.history'],
                ],
            ],
            // Devices
            [
                'label' => 'Devices',
                'icon' => 'fas fa-microchip',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Verify Device', 'icon' => 'fas fa-qrcode', 'route' => 'mechanic.devices.scan'],
                    ['label' => 'Register Mechanical Equipment', 'icon' => 'fas fa-plus', 'route' => 'mechanic.devices.register'],
                ],
            ],
            // Spare Parts
            [
                'label' => 'Spare Parts',
                'icon' => 'fas fa-cogs',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Parts', 'icon' => 'fas fa-hand-holding', 'route' => 'mechanic.parts.request'],
                    ['label' => 'Used Parts Log', 'icon' => 'fas fa-recycle', 'route' => 'mechanic.parts.log'],
                ],
            ],
            // Earnings
            [
                'label' => 'Earnings',
                'icon' => 'fas fa-wallet',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Earnings Summary', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'mechanic.earnings.summary'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-user-circle', 'route' => 'mechanic.profile.view'],
                ],
            ],
        ],
        'electrician' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'electrician.dashboard.overview'],
                    ['label' => 'Electrical Jobs Map', 'icon' => 'fas fa-map-marked-alt', 'route' => 'electrician.dashboard.map'],
                ],
            ],
            // Repairs
            [
                'label' => 'Repairs',
                'icon' => 'fas fa-bolt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Electrical Repairs', 'icon' => 'fas fa-clipboard-list', 'route' => 'electrician.repairs.assigned'],
                    ['label' => 'Update Repair Progress', 'icon' => 'fas fa-sync', 'route' => 'electrician.repairs.update_progress'],
                    ['label' => 'Completed Electrical Repairs', 'icon' => 'fas fa-check-circle', 'route' => 'electrician.repairs.completed'],
                ],
            ],
            // Devices
            [
                'label' => 'Devices',
                'icon' => 'fas fa-microchip',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Verify Electrical Devices', 'icon' => 'fas fa-qrcode', 'route' => 'electrician.devices.scan'],
                    ['label' => 'Register Device', 'icon' => 'fas fa-plus', 'route' => 'electrician.devices.register'],
                ],
            ],
            // Materials
            [
                'label' => 'Materials',
                'icon' => 'fas fa-boxes',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Electrical Materials', 'icon' => 'fas fa-hard-hat', 'route' => 'electrician.materials.request'],
                    ['label' => 'Used Materials Log', 'icon' => 'fas fa-clipboard-check', 'route' => 'electrician.materials.log'],
                ],
            ],
            // Earnings
            [
                'label' => 'Earnings',
                'icon' => 'fas fa-wallet',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Earnings', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'electrician.earnings.index'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-user-circle', 'route' => 'electrician.profile.view'],
                ],
            ],
        ],
        'builder' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'builder.dashboard.overview'],
                    ['label' => 'Site Locations Map', 'icon' => 'fas fa-map-marked-alt', 'route' => 'builder.dashboard.map'],
                ],
            ],
            // Projects
            [
                'label' => 'Projects',
                'icon' => 'fas fa-city',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Projects', 'icon' => 'fas fa-tasks', 'route' => 'builder.projects.assigned'],
                    ['label' => 'Update Work Progress', 'icon' => 'fas fa-sync', 'route' => 'builder.projects.update_progress'],
                    ['label' => 'Completed Projects', 'icon' => 'fas fa-check-circle', 'route' => 'builder.projects.completed'],
                ],
            ],
            // Equipment
            [
                'label' => 'Equipment',
                'icon' => 'fas fa-tools',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Equipment', 'icon' => 'fas fa-plus', 'route' => 'builder.equipment.register'],
                    ['label' => 'Verify Equipment', 'icon' => 'fas fa-qrcode', 'route' => 'builder.equipment.verify'],
                ],
            ],
            // Materials
            [
                'label' => 'Materials',
                'icon' => 'fas fa-cubes',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Materials', 'icon' => 'fas fa-dolly', 'route' => 'builder.materials.request'],
                    ['label' => 'Usage Logs', 'icon' => 'fas fa-clipboard-check', 'route' => 'builder.materials.logs'],
                ],
            ],
            // Payments
            [
                'label' => 'Payments',
                'icon' => 'fas fa-wallet',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Earnings', 'icon' => 'fas fa-dollar-sign', 'route' => 'builder.payments.earnings'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-hard-hat',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-user-circle', 'route' => 'builder.profile.view'],
                ],
            ],
        ],
        'tailor' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'tailor.dashboard.overview'],
                    ['label' => 'Client Locations Map', 'icon' => 'fas fa-map-marked-alt', 'route' => 'tailor.dashboard.map'],
                ],
            ],
            // Orders
            [
                'label' => 'Orders',
                'icon' => 'fas fa-shopping-bag',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Orders', 'icon' => 'fas fa-clipboard-list', 'route' => 'tailor.orders.assigned'],
                    ['label' => 'Update Order Status', 'icon' => 'fas fa-sync', 'route' => 'tailor.orders.update_status'],
                    ['label' => 'Completed Orders', 'icon' => 'fas fa-check-circle', 'route' => 'tailor.orders.completed'],
                ],
            ],
            // Measurements
            [
                'label' => 'Measurements',
                'icon' => 'fas fa-ruler-combined',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Record Measurements', 'icon' => 'fas fa-pen-fancy', 'route' => 'tailor.measurements.record'],
                    ['label' => 'Client History', 'icon' => 'fas fa-history', 'route' => 'tailor.measurements.history'],
                ],
            ],
            // Earnings
            [
                'label' => 'Earnings',
                'icon' => 'fas fa-wallet',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Payments', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'tailor.earnings.payments'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-user-circle', 'route' => 'tailor.profile.view'],
                ],
            ],
        ],
        'craftsperson' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'craftsperson.dashboard.overview'],
                    ['label' => 'Work Locations Map', 'icon' => 'fas fa-map-marked-alt', 'route' => 'craftsperson.dashboard.map'],
                ],
            ],
            // Jobs
            [
                'label' => 'Jobs',
                'icon' => 'fas fa-hammer',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Craft Jobs', 'icon' => 'fas fa-tasks', 'route' => 'craftsperson.jobs.assigned'],
                    ['label' => 'Update Job Status', 'icon' => 'fas fa-sync', 'route' => 'craftsperson.jobs.update_status'],
                    ['label' => 'Completed Jobs', 'icon' => 'fas fa-check-circle', 'route' => 'craftsperson.jobs.completed'],
                ],
            ],
            // Tools
            [
                'label' => 'Tools',
                'icon' => 'fas fa-tools',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Tools', 'icon' => 'fas fa-plus', 'route' => 'craftsperson.tools.register'],
                    ['label' => 'Verify Tools', 'icon' => 'fas fa-qrcode', 'route' => 'craftsperson.tools.verify'],
                ],
            ],
            // Earnings
            [
                'label' => 'Earnings',
                'icon' => 'fas fa-wallet',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Earnings Summary', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'craftsperson.earnings.summary'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-cog',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-user-circle', 'route' => 'craftsperson.profile.view'],
                ],
            ],
        ],
        'business' => [ // businessperson
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Business Overview', 'icon' => 'fas fa-eye', 'route' => 'business.dashboard.overview'],
                    ['label' => 'Sales Map', 'icon' => 'fas fa-map-marked-alt', 'route' => 'business.dashboard.map'],
                ],
            ],
            // Products & Services
            [
                'label' => 'Products & Services',
                'icon' => 'fas fa-boxes',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Products', 'icon' => 'fas fa-box-open', 'route' => 'business.products.index'],
                    ['label' => 'My Services', 'icon' => 'fas fa-concierge-bell', 'route' => 'business.services.index'],
                    ['label' => 'Spare Parts', 'icon' => 'fas fa-cogs', 'route' => 'business.products.parts'],
                    ['label' => 'Pricing', 'icon' => 'fas fa-tag', 'route' => 'business.products.pricing'],
                ],
            ],
            // Repairs
            [
                'label' => 'Repairs',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Repair Orders', 'icon' => 'fas fa-clipboard-list', 'route' => 'business.repairs.orders'],
                    ['label' => 'Assign Technicians', 'icon' => 'fas fa-user-plus', 'route' => 'business.repairs.assign'],
                    ['label' => 'Repair History', 'icon' => 'fas fa-history', 'route' => 'business.repairs.history'],
                ],
            ],
            // Marketplace
            [
                'label' => 'Marketplace',
                'icon' => 'fas fa-store',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Listings', 'icon' => 'fas fa-list', 'route' => 'business.marketplace.listings'],
                    ['label' => 'Orders', 'icon' => 'fas fa-shopping-basket', 'route' => 'business.marketplace.orders'],
                    ['label' => 'Returns', 'icon' => 'fas fa-undo', 'route' => 'business.marketplace.returns'],
                ],
            ],
            // Clients
            [
                'label' => 'Clients',
                'icon' => 'fas fa-users',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Customers', 'icon' => 'fas fa-user-friends', 'route' => 'business.clients.index'],
                    ['label' => 'Service History', 'icon' => 'fas fa-file-medical-alt', 'route' => 'business.clients.history'],
                ],
            ],
            // Invoices & Payments
            [
                'label' => 'Invoices & Payments',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Invoices', 'icon' => 'fas fa-file-invoice', 'route' => 'business.invoices.index'],
                    ['label' => 'Payments', 'icon' => 'fas fa-money-bill-wave', 'route' => 'business.payments.index'],
                    ['label' => 'Commissions', 'icon' => 'fas fa-percentage', 'route' => 'business.payments.commissions'],
                ],
            ],
            // Reports
            [
                'label' => 'Reports',
                'icon' => 'fas fa-chart-line',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Sales Reports', 'icon' => 'fas fa-chart-bar', 'route' => 'business.reports.sales'],
                    ['label' => 'Repair Reports', 'icon' => 'fas fa-tools', 'route' => 'business.reports.repairs'],
                ],
            ],
            // Subscription
            [
                'label' => 'Subscription',
                'icon' => 'fas fa-star',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Plan Status', 'icon' => 'fas fa-info-circle', 'route' => 'business.subscription.status'],
                    ['label' => 'Upgrade Plan', 'icon' => 'fas fa-arrow-circle-up', 'route' => 'business.subscription.upgrade'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-tie',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Business Profile', 'icon' => 'fas fa-id-card', 'route' => 'business.profile.view'],
                ],
            ],
        ],
        'mediator' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'mediator.dashboard.overview'],
                    ['label' => 'Dispute Locations Map', 'icon' => 'fas fa-map-marked-alt', 'route' => 'mediator.dashboard.map'],
                ],
            ],
            // Cases
            [
                'label' => 'Cases',
                'icon' => 'fas fa-briefcase',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Assigned Cases', 'icon' => 'fas fa-gavel', 'route' => 'mediator.cases.assigned'],
                    ['label' => 'Open Disputes', 'icon' => 'fas fa-folder-open', 'route' => 'mediator.cases.open'],
                    ['label' => 'Resolved Cases', 'icon' => 'fas fa-check-circle', 'route' => 'mediator.cases.resolved'],
                ],
            ],
            // Disputes
            [
                'label' => 'Disputes',
                'icon' => 'fas fa-balance-scale',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Repair Disputes', 'icon' => 'fas fa-tools', 'route' => 'mediator.disputes.repair'],
                    ['label' => 'Sales Disputes', 'icon' => 'fas fa-shopping-cart', 'route' => 'mediator.disputes.sales'],
                    ['label' => 'Theft Claims', 'icon' => 'fas fa-exclamation-triangle', 'route' => 'mediator.disputes.theft'],
                ],
            ],
            // Reports
            [
                'label' => 'Reports',
                'icon' => 'fas fa-chart-line',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Case Reports', 'icon' => 'fas fa-file-alt', 'route' => 'mediator.reports.cases'],
                    ['label' => 'Resolution Reports', 'icon' => 'fas fa-handshake', 'route' => 'mediator.reports.resolution'],
                ],
            ],
            // Communication
            [
                'label' => 'Communication',
                'icon' => 'fas fa-comments',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Messages', 'icon' => 'fas fa-envelope', 'route' => 'mediator.communication.messages'],
                    ['label' => 'Meetings', 'icon' => 'fas fa-calendar-alt', 'route' => 'mediator.communication.meetings'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-shield',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-id-badge', 'route' => 'mediator.profile.view'],
                ],
            ],
        ],
        'client' => [
            // Dashboard
            [
                'label' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Overview', 'icon' => 'fas fa-eye', 'route' => 'client.dashboard.overview'],
                    ['label' => 'Nearby Service Centers', 'icon' => 'fas fa-map-marked-alt', 'route' => 'client.dashboard.map'],
                ],
            ],
            // My Devices
            [
                'label' => 'My Devices',
                'icon' => 'fas fa-laptop',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Register Device', 'icon' => 'fas fa-plus', 'route' => 'client.devices.register'],
                    ['label' => 'My Registered Devices', 'icon' => 'fas fa-laptop-house', 'route' => 'client.devices.list'],
                    ['label' => 'Device History', 'icon' => 'fas fa-history', 'route' => 'client.devices.history'],
                    ['label' => 'Warranty Records', 'icon' => 'fas fa-file-contract', 'route' => 'client.devices.warranty'],
                ],
            ],
            // Repairs
            [
                'label' => 'Repairs',
                'icon' => 'fas fa-wrench',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Request Repair', 'icon' => 'fas fa-tools', 'route' => 'client.repairs.request'],
                    ['label' => 'Repair Status', 'icon' => 'fas fa-info-circle', 'route' => 'client.repairs.status'],
                    ['label' => 'Repair History', 'icon' => 'fas fa-history', 'route' => 'client.repairs.history'],
                ],
            ],
            // Security
            [
                'label' => 'Security',
                'icon' => 'fas fa-shield-alt',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Report Stolen Device', 'icon' => 'fas fa-exclamation-triangle', 'route' => 'client.security.report_stolen'],
                    ['label' => 'Track Device', 'icon' => 'fas fa-map-marker-alt', 'route' => 'client.security.track'],
                    ['label' => 'Recovery Status', 'icon' => 'fas fa-search-location', 'route' => 'client.security.recovery'],
                ],
            ],
            // Marketplace
            [
                'label' => 'Marketplace',
                'icon' => 'fas fa-store',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Browse Products', 'icon' => 'fas fa-shopping-bag', 'route' => 'client.marketplace.browse'],
                    ['label' => 'My Orders', 'icon' => 'fas fa-clipboard-list', 'route' => 'client.marketplace.orders'],
                    ['label' => 'Order History', 'icon' => 'fas fa-history', 'route' => 'client.marketplace.history'],
                ],
            ],
            // Invoices & Payments
            [
                'label' => 'Invoices & Payments',
                'icon' => 'fas fa-file-invoice-dollar',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Invoices', 'icon' => 'fas fa-file-invoice', 'route' => 'client.invoices.index'],
                    ['label' => 'Payments', 'icon' => 'fas fa-credit-card', 'route' => 'client.payments.index'],
                ],
            ],
            // Support
            [
                'label' => 'Support',
                'icon' => 'fas fa-headset',
                'dropdown' => true,
                'items' => [
                    ['label' => 'Messages', 'icon' => 'fas fa-envelope', 'route' => 'client.support.messages'],
                    ['label' => 'Complaints', 'icon' => 'fas fa-frown', 'route' => 'client.support.complaints'],
                ],
            ],
            // Profile
            [
                'label' => 'Profile',
                'icon' => 'fas fa-user-circle',
                'dropdown' => true,
                'items' => [
                    ['label' => 'My Profile', 'icon' => 'fas fa-id-card', 'route' => 'client.profile.view'],
                ],
            ],
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
