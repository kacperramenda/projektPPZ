export default {
    title: 'projektPPZ Docs',
    description: 'Project documentation for frontend and backend',
    themeConfig: {
        sidebar: [
            {
                text: 'Welcome',
                link: '/'
            },
            {
                text: 'About',
                link: '/about'
            },
            {
                text: 'Frontend',
                items: [
                    {
                        text: 'Components',
                        link: '/frontend/components/',
                        items: [
                            { text: 'Admin',
                                items: [
                                    { text: 'Header', link: '/frontend/components/admin/Header.md' },
                                    { text: 'Sidebar', link: '/frontend/components/admin/Sidebar.md' },
                                    { text: 'Menu', link: '/frontend/components/admin/Menu.md' },
                                    { text: 'MenuItem', link: '/frontend/components/admin/MenuItem.md' },
                                    { text: 'Panel', link: '/frontend/components/admin/Profile.md'},
                                    { text: 'Profile', link: '/frontend/components/admin/Panel.md'},
                                ]
                            },
                            { text: 'Forms',
                                items: [
                                    { text: 'Input', link: '/frontend/components/forms/Input.md' },
                                    { text: 'Textarea', link: '/frontend/components/forms/Textarea.md' }
                                ]
                            },
                            {
                                text: 'Icons',
                                items: [
                                    { text: 'Icon', link: '/frontend/components/icons/Logout.md' },
                                    { text: 'IconButton', link: '/frontend/components/icons/UserIcon.md' }
                                ]
                            },
                            {
                                text: 'Table',
                                link: '/frontend/components/table/Table.md',
                            },
                            {
                                text: 'Toasts',
                                items: [
                                    { text: 'Toast', link: '/frontend/components/toasts/Toast.md' },
                                    { text: 'ToastContainer', link: '/frontend/components/toasts/ToastContainer.md' }
                                ]
                            },
                            {
                                text: 'Utils',
                                items: [
                                    { text: 'Modal', link: '/frontend/components/utils/Modal.md' },
                                ]
                            }
                        ]
                    },
                    { text: 'Layouts', link: '/frontend/layouts/' },
                    { text: 'Pages',
                        items: [
                            {
                                text: 'Admin',
                                items: [
                                    { text: 'Dashboard', link: '/frontend/pages/admin/dashboard/index.md' },
                                    {
                                        text: 'Users',
                                        items: [
                                            { text: 'Edit', link: '/frontend/pages/admin/users/Edit.md' },
                                            { text: 'Users', link: '/frontend/pages/admin/users/Users.md' }
                                        ]
                                    },
                                ]
                            },
                            {
                                text: 'Auth',
                                link: '/frontend/pages/auth/',
                                items: [
                                    { text: 'Login', link: '/frontend/pages/auth/login.md' },
                                    { text: 'Register', link: '/frontend/pages/auth/register.md' }
                                ]
                            },
                            { text: 'User', link: '/frontend/pages/user/user.md' },
                        ]
                    },
                    { text: 'Stores',
                        items: [
                            { text: 'useToastStore', link: '/frontend/stores/UseToastStore.md' }
                        ]
                    }
                ]
            },
            {
                text: 'Backend',
                items: [
                    { text: 'Endpoints Documentation', link: '/backend/scribe.md' },
                    { text: 'Models and Controllers Documentation', link: '/backend/phpdoc.md' }
                ]
            }
        ]
    }
}
