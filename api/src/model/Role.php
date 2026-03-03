<?php

namespace api\model;

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';
}