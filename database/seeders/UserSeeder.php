<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Local;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $company = Company::create([
            'ruc' => '20447393302',
            'razonsocial' => 'TICOM',
            'ubigeo' => "150101",
            'direccion' => 'Av. Peru 1255',
            'currency_id' => 1,
            'soluser' => "MODDATOS",
            'solpass' => "MODDATOS",
            'ublversion' => "2.1",
            'detraccion' => 700,
            'certificate_path' => 'fe/certificados/dy2eLjhjZJvYb9P2XOM86KTqC8sfpoQIE9vmw4zb.txt',
            //'logo' => 'fe/logos/0jdmPxuXhJXZ4IFjjN11goSZYMg26HkpQ8zg2GOS.png',
            'logo' => '',
            'certificate_path' => "certificates/certificate_1.pem",
            'certificado' => "-----BEGIN PRIVATE KEY-----
            MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDUHbPExymJyOWE
            bxY4TlCufbh54zUAonBNU0hkfCsuLXOIz2KCmH6bTdO907Ms9dTqkcXMwxD87/o8
            qwyRaNiIGTsqrSSshMxkJy5t+folVXUrUNf3IDz1Y6zulyxzQdVFx1ThDIPITtF6
            wQ+paBhobLFFgkul4DtEA9dMAp7VBoGdUpdzuOIF7v/UyMUF7hsxRMAXAqnMBnlt
            bTytNN5j7HBq0sWNvduVn6xW2mimZIplUSWykvYbnfQv2HqS4DX/f18+5ULLFmzB
            Erhme9d6DM7SXY44GbT0AkA9du0dApoQFhAqNMKFZYvGa5axWYeLHfF32g81nG/I
            18yGrcfRAgMBAAECggEADoQd2lia4iAKfP6xMZdCdD6MUmMXLHzxXIlXifDpb5aS
            sokmv7M57tzrobEMMQZ91LO3KqUq03SE1oQKLyVStDWt0+TXfqrz5eK8jbAuy0FG
            7Hjy3qmpIk349rcHxrd5pfXXPDOEDUA/m7v8m2ZRTUwq8YvSK37l72in4j7HqeJR
            HvFbf/G1GqRpyKQO8aRenPmtE4gD9JVIRFIj6tNaSvBzRpnDTGDpYUriOISic3WJ
            YMHr2ANM2hKTz2YQG7JmRvwGR1zULTLNyoThLFtP6MTOgq04zfWB55ZLveO8JCww
            HxuK85+k5MQ4GSu1nUe+HLxS7uZ5625w7ZB+t42iAQKBgQD69+DV3xL1R7XYckQ6
            TZ6MG8aZYOPqIMEvLyThUGvc6afz3aPhn7494I+jmBqK9P3juVG0RG1MS84mwpG2
            mg9qwzY213OQvasdbi/KFN8kMdt7AYu5IJ0ISHCGv3fMXi3+mOD6MlG3BMsngNow
            6uml2H0z8Pv1FVqooygP0uNycQKBgQDYXmkcqWnCtnzwh1fCKTII0GkWCE8RJNXv
            6N52Im9T4hvys9LT00YCJ6ma2EWpSflpLkreDj71BVPVTh5TFUTk9M4xvjLDdcLQ
            E27oFWxIMmeX/2lZnoS6/d2tm++Zwi3rXA6N0zVENzFfruPVBeOAaFfP5L1KtKRj
            4uE1bAWbYQKBgQCHMZDEpW6pAwBKoQNwBPAruaq6ZR9huFNY/6R2W8Q/NP9stzDZ
            EhyBaL73+bASuvcp/WKuIU5fk1ZyOs4T99nmQVKrKFTw27uaFwlXavbpoJIDKUoD
            aDYviBZWAD6gsPtF80T+gqzSUpq9pQPk5icHWB/aIy8XT3GO9pVWMNylgQKBgCCi
            lN4i23XoCo5JC76YchiMPt144VwnnzExgaR16y7O0wJXhzw2CMA4dUeKyW8QXlM0
            DUzS/0H7zLpGryI++gZCunscQhHjSEAUPk05NfzpxWBSwPQoicKemfoepBQgCscO
            Oo+/xLAGVyckfO7blYX/twb/bGHBP25lgSyKn4nhAoGACvOKOL9vyziaLeISY85f
            jG1TfeCKG7zsbw95Oy4qfccpSUUgLFuR35A56G0OAc7GNXqrTZ6UjrAJltT5bG+J
            u5grbeJ4i1pF/6xoh/pjtfWLUUbsghgRqCqv0z5YemopXTEpVE/vPPC2JhZHfTVO
            nnk/MZT7Cwl87tYexykKDbc=
            -----END PRIVATE KEY-----
            -----BEGIN CERTIFICATE-----
            MIIFCDCCA/CgAwIBAgIJAMwye7towTY2MA0GCSqGSIb3DQEBCwUAMIIBDTEbMBkG
            CgmSJomT8ixkARkWC0xMQU1BLlBFIFNBMQswCQYDVQQGEwJQRTENMAsGA1UECAwE
            TElNQTENMAsGA1UEBwwETElNQTEYMBYGA1UECgwPVFUgRU1QUkVTQSBTLkEuMUUw
            QwYDVQQLDDxETkkgOTk5OTk5OSBSVUMgMjA2MDkyNzgyMzUgLSBDRVJUSUZJQ0FE
            TyBQQVJBIERFTU9TVFJBQ0nDk04xRDBCBgNVBAMMO05PTUJSRSBSRVBSRVNFTlRB
            TlRFIExFR0FMIC0gQ0VSVElGSUNBRE8gUEFSQSBERU1PU1RSQUNJw5NOMRwwGgYJ
            KoZIhvcNAQkBFg1kZW1vQGxsYW1hLnBlMB4XDTIzMDUyNTE0NDIyMVoXDTI1MDUy
            NDE0NDIyMVowggENMRswGQYKCZImiZPyLGQBGRYLTExBTUEuUEUgU0ExCzAJBgNV
            BAYTAlBFMQ0wCwYDVQQIDARMSU1BMQ0wCwYDVQQHDARMSU1BMRgwFgYDVQQKDA9U
            VSBFTVBSRVNBIFMuQS4xRTBDBgNVBAsMPEROSSA5OTk5OTk5IFJVQyAyMDYwOTI3
            ODIzNSAtIENFUlRJRklDQURPIFBBUkEgREVNT1NUUkFDScOTTjFEMEIGA1UEAww7
            Tk9NQlJFIFJFUFJFU0VOVEFOVEUgTEVHQUwgLSBDRVJUSUZJQ0FETyBQQVJBIERF
            TU9TVFJBQ0nDk04xHDAaBgkqhkiG9w0BCQEWDWRlbW9AbGxhbWEucGUwggEiMA0G
            CSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDUHbPExymJyOWEbxY4TlCufbh54zUA
            onBNU0hkfCsuLXOIz2KCmH6bTdO907Ms9dTqkcXMwxD87/o8qwyRaNiIGTsqrSSs
            hMxkJy5t+folVXUrUNf3IDz1Y6zulyxzQdVFx1ThDIPITtF6wQ+paBhobLFFgkul
            4DtEA9dMAp7VBoGdUpdzuOIF7v/UyMUF7hsxRMAXAqnMBnltbTytNN5j7HBq0sWN
            vduVn6xW2mimZIplUSWykvYbnfQv2HqS4DX/f18+5ULLFmzBErhme9d6DM7SXY44
            GbT0AkA9du0dApoQFhAqNMKFZYvGa5axWYeLHfF32g81nG/I18yGrcfRAgMBAAGj
            ZzBlMB0GA1UdDgQWBBShW9h2j1hnFWmHL+95E8qbgMHlwDAfBgNVHSMEGDAWgBSh
            W9h2j1hnFWmHL+95E8qbgMHlwDATBgNVHSUEDDAKBggrBgEFBQcDATAOBgNVHQ8B
            Af8EBAMCB4AwDQYJKoZIhvcNAQELBQADggEBABWmSUiUwKCR+E//0BBCngo3vT3b
            J13diCsoPOIcWzRQqE+qQ+pbBwXISke5w0gv6+gV/E/r8yiNqwuJnoM1/5jyFe4j
            mF2gIgL0kpiWtnkrT4qn24Y5t/FuQKJtbZx4ec0Uh6n7NzmUoTjm2tP42IqhLQSn
            GhWXXnXxh9XGjeVc7SdCIsyvAQ+CbTXJPvIfwTpTtg500NOQaGEIP3lBd5dNLcEp
            sErwCa4Ln2Hob2wSXeA3FX8qutkHhiVyGAxaLsy2aW5xVBeR4G24WAYtnjiARYTm
            Q03NoAh6oA46zA1LzaF+lpcIPbqNAdb4B4gJ0os+mCgwXx8DkEMSSZvWUMI=
            -----END CERTIFICATE-----
            ",
        ]);


        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $sellerRole = Role::create(['name' => 'Seller', 'display_name' => 'Vendedor']);
        $grocerRole = Role::create(['name' => 'Grocer', 'display_name' => 'Almacenero']);

        Permission::create(['name' => 'User List', 'display_name' => 'Listar Usuarios', 'model_name' => 'User'])->SyncRoles([$adminRole]); //hay que analizar este para dar permiso de ver la lista
        Permission::create(['name' => 'User View', 'display_name' => 'Ver Usuario', 'model_name' => 'User'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'User Create', 'display_name' => 'Crear Usuario', 'model_name' => 'User'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'User Update', 'display_name' => 'Actualizar Usuario', 'model_name' => 'User'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'User Delete', 'display_name' => 'Eliminar Usuario', 'model_name' => 'User'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Permission List', 'display_name' => 'Listar Permisos', 'model_name' => 'Permission'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Permission View', 'display_name' => 'Ver Permiso', 'model_name' => 'Permission'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Permission Update', 'display_name' => 'Actualizar Permiso', 'model_name' => 'Permission'])->SyncRoles([$adminRole]);

        Permission::create(['name' => 'Role List', 'display_name' => 'Listar Roles', 'model_name' => 'Role'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Role View', 'display_name' => 'Ver Rol', 'model_name' => 'Role'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Role Create', 'display_name' => 'Crear Rol', 'model_name' => 'Role'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Role Update', 'display_name' => 'Actualizar Rol', 'model_name' => 'Role'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Role Delete', 'display_name' => 'Eliminar Rol', 'model_name' => 'Role'])->SyncRoles([$adminRole]);

        //Permission::create(['name' => 'Local List', 'display_name' => 'Listar Locales', 'model_name' => 'Local'])->SyncRoles([$adminRole]);
        //Permission::create(['name' => 'Local View', 'display_name' => 'Ver Local', 'model_name' => 'Local'])->SyncRoles([$adminRole]);
        //Permission::create(['name' => 'Local Create', 'display_name' => 'Crear Local', 'model_name' => 'Local'])->SyncRoles([$adminRole]);
        //Permission::create(['name' => 'Local Update', 'display_name' => 'Actualizar Local', 'model_name' => 'Local'])->SyncRoles([$adminRole]);
        //Permission::create(['name' => 'Local Delete', 'display_name' => 'Eliminar Local', 'model_name' => 'Local'])->SyncRoles([$adminRole]);

        //php artisan make:policy CategoryPolicy --model=Category
        Permission::create(['name' => 'Category List', 'display_name' => 'Listar categorias', 'model_name' => 'Category'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Category View', 'display_name' => 'Ver Categoria', 'model_name' => 'Category'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Category Create', 'display_name' => 'Crear Categoria', 'model_name' => 'Category'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Category Update', 'display_name' => 'Actualizar Categoria', 'model_name' => 'Category'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Category Delete', 'display_name' => 'Eliminar Categoria', 'model_name' => 'Category'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Lead List', 'display_name' => 'Listar Leads', 'model_name' => 'Lead'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Lead View', 'display_name' => 'Ver Lead', 'model_name' => 'Lead'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Lead Create', 'display_name' => 'Crear Lead', 'model_name' => 'Lead'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Lead Update', 'display_name' => 'Actualizar Lead', 'model_name' => 'Lead'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Lead Delete', 'display_name' => 'Eliminar Lead', 'model_name' => 'Lead'])->SyncRoles([$adminRole]);



        Permission::create(['name' => 'Crm List', 'display_name' => 'Listar Crms', 'model_name' => 'Crm'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Crm View', 'display_name' => 'Ver Crm', 'model_name' => 'Crm'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Crm Create', 'display_name' => 'Crear Crm', 'model_name' => 'Crm'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Crm Update', 'display_name' => 'Actualizar Crm', 'model_name' => 'Crm'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Crm Delete', 'display_name' => 'Eliminar Crm', 'model_name' => 'Crm'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Producto List', 'display_name' => 'Listar Productos', 'model_name' => 'Producto'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Producto View', 'display_name' => 'Ver Producto', 'model_name' => 'Producto'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Producto Create', 'display_name' => 'Crear Producto', 'model_name' => 'Producto'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Producto Update', 'display_name' => 'Actualizar Producto', 'model_name' => 'Producto'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Producto Delete', 'display_name' => 'Eliminar Producto', 'model_name' => 'Producto'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Tipomarketing List', 'display_name' => 'Listar Tipomarketings', 'model_name' => 'Tipomarketing'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Tipomarketing View', 'display_name' => 'Ver Tipomarketing', 'model_name' => 'Tipomarketing'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Tipomarketing Create', 'display_name' => 'Crear Tipomarketing', 'model_name' => 'Tipomarketing'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Tipomarketing Update', 'display_name' => 'Actualizar Tipomarketing', 'model_name' => 'Tipomarketing'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Tipomarketing Delete', 'display_name' => 'Eliminar Tipomarketing', 'model_name' => 'Tipomarketing'])->SyncRoles([$adminRole]);


        Permission::create(['name' => 'Brand List', 'display_name' => 'Listar Brands', 'model_name' => 'Brand'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand View', 'display_name' => 'Ver Brand', 'model_name' => 'Brand'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand Create', 'display_name' => 'Crear Brand', 'model_name' => 'Brand'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand Update', 'display_name' => 'Actualizar Brand', 'model_name' => 'Brand'])->SyncRoles([$adminRole]);
        Permission::create(['name' => 'Brand Delete', 'display_name' => 'Eliminar Brand', 'model_name' => 'Brand'])->SyncRoles([$adminRole]);



        //creando local principal de company
        //$local = Local::create([
        //    'name' => 'local principal',
        //'company_id' => $company->id,
        //]);

        // $local = Local::create([
        //    'name' => 'local secundario',
        //'company_id' => $company->id,
        //]);

        //creando posicion o profesion o cargo
        $position = Position::create([
            'name' => 'Administrador',
            //'company_id' => $company->id,
        ]);

        //creando usuario admin
        $admin = User::create([
            'name' => 'Michael',
            'email' => 'michael@ticomperu.com',
            'email_verified_at' => now(),
            'state' => true,
            //'company_id' => $company->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole($adminRole);

        //creando empleado admin
        Employee::create([
            'address' => 'Av Jose galvez 1731',
            'movil' => '996929478',
            'dni' => '10133423',
            'gender' => 1,
            'state' => true,
            'user_id' => $admin->id,
            //'local_id' => $local->id,
            'position_id' => $position->id,
            //'company_id' => $company->id,
            'photo' => 'fe/default/users/userdefault.jpg',

        ]);

        //creando usuario vendedor
        $seller = User::create([
            'name' => 'luis',
            'email' => 'luis@ticomperu.com',
            'email_verified_at' => now(),
            'state' => true,
            //'company_id' => $company->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $seller->assignRole($sellerRole);

        //creando empleado admin
        Employee::create([
            'address' => 'Av Jose galvez 1731',
            'movil' => '996929478',
            'dni' => '10133423',
            'gender' => 1,
            'state' => true,
            'user_id' => $seller->id,
            //'local_id' => $local->id,
            'position_id' => $position->id,
            //'company_id' => $company->id,
            'photo' => 'fe/default/users/userdefault.jpg',

        ]);


        //creando usuario vendedor
        $seller2 = User::create([
            'name' => 'Mario',
            'email' => 'mario@ticomperu.com',
            'email_verified_at' => now(),
            'state' => true,
            //'company_id' => $company->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $seller2->assignRole($sellerRole);

        //creando empleado admin
        Employee::create([
            'address' => 'Av petith thouars 3022',
            'movil' => '996929470',
            'dni' => '10133424',
            'gender' => 1,
            'state' => true,
            'user_id' => $seller2->id,
            //'local_id' => $local->id,
            'position_id' => $position->id,
            //'company_id' => $company->id,
            'photo' => 'fe/default/users/userdefault.jpg',

        ]);
    }
}
