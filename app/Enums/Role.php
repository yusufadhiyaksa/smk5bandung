<?php

namespace App\Enums;

enum Role:string
{
    case SUPERADMIN = "superadmin";
    case KURIKULUM = "kurikulum";
    case PENGAJAR = "pengajar";
}
