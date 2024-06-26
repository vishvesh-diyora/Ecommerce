import ProductSectionComponent from "../../components/admin/productSections/ProductSectionComponent";
import ProductSectionListComponent from "../../components/admin/productSections/ProductSectionListComponent";
import ProductSectionShowComponent from "../../components/admin/productSections/ProductSectionShowComponent";

export default [
    {
        path: '/admin/product-sections',
        component: ProductSectionComponent,
        name: 'admin.product-sections',
        redirect: {name: 'admin.product-sections'},
        meta: {
            isFrontend: false,
            auth: true,
            permissionUrl: 'product-sections',
            breadcrumb: 'product_sections'
        },
        children: [
            {
                path: '',
                component: ProductSectionListComponent,
                name: 'admin.product-sections',
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: 'product-sections',
                    breadcrumb: ''
                },
            },
            {
                path: "show/:id",
                component: ProductSectionShowComponent,
                name: "admin.product-sections.show",
                meta: {
                    isFrontend: false,
                    auth: true,
                    permissionUrl: "product-sections",
                    breadcrumb: "view",
                },
            },
        ]
    }
]
