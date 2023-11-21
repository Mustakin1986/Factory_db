import Dashboard from './components/Dashboard.vue';
import ProductList from './pages/product/ListProduct.vue';
import UserLists from './pages/users/UserLists.vue';
import User from './pages/users/User.vue';
import addUser from './pages/users/addUser.vue';
import profile from './pages/users/profile.vue'
import add_category from './pages/category/add_category.vue';
import categoryList from './pages/category/categoryList.vue';
import add_brand from './pages/brand/add_brand.vue';
import brandList from './pages/brand/brandList.vue';
import efficiency from './pages/Efficiency/efficiency.vue';
import factorySetting from './pages/setting/factorySetting.vue';
import line from './pages/setting/line.vue'
import smv_library from './pages/Efficiency/Smv_library.vue';
import smv_list from './pages//Efficiency/smv_list.vue';
import new_order from './pages/order_master/new_order.vue';
import all_invoice from './pages/invoice/all_invoice.vue';
import single_unite from './pages/Efficiency/single_unite.vue'

export default [

    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard,
    },
    {
        path: '/admin/ProductList',
        name: 'ProductList',
        component: ProductList,
    },

    {
        path: '/admin/user_lists',
        name: 'UserLists',
        component: UserLists,
    },

    {
        path: '/admin/user',
        name: 'admin.User.create',
        component: User,
    },

    {
        path: '/admin/user/:id/edit',
        name: 'EditUser',
        component: User,
    },
    {
        path: '/admin/addUser',
        name: 'admin.addUser.create',
        component: addUser,
    },

    {
        path: '/admin/profile',
        name: 'admin.profile',
        component: profile,
    },
    // Category
    {
        path: '/admin/add_category',
        name: 'admin.add_category',
        component: add_category,
    },

    {
        path: '/admin/categoryList',
        name: 'admin.categoryList',
        component: categoryList,
    },

    //Brand
    {
        path: '/admin/add_brand',
        name: 'admin.add_brand',
        component: add_brand,
    },
    {
        path: '/admin/brandList',
        name: 'admin.brandList',
        component: brandList,
    },

    // Efficiency

    {
        path: '/admin/efficiency',
        name: 'admin.efficiency',
        component: efficiency,
    },
    {
        path: '/admin/single_unite',
        name: 'admin.single_unite',
        component: single_unite,
    },
    // smv library
    {
        path: '/admin/smv_list',
        name: 'admin.smv_list',
        component: smv_list,
    },
    {
        path: '/admin/smv_library',
        name: 'admin.smv_library',
        component: smv_library,
    },


    // Setting
    {
        path: '/admin/factorySetting',
        name: 'admin.factorySetting',
        component: factorySetting,
    },
    {
        path: '/admin/line',
        name: 'admin.line.create',
        component: line,
    },

    //order master
    {
        path: '/admin/new_order',
        name: 'admin.new_order',
        component: new_order,
    },
    {
        path: '/admin/all_invoice',
        name: 'admin.all_invoice',
        component: all_invoice,
    },


]
