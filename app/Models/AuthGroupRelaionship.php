<?php
/**
 * 权限组关系模型
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.1
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthGroupRelaionship extends Model
{
    /**
     * 表名.
     *
     * @var string.
     */
    const TABLE_NAME = 'auth_group_relationship';

    /**
     * 新增权限与权限组关系.
     *
     * @param string $group_label 权限组标识.
     * @param array $auth_label 权限标识.
     *
     * @return boolean
     */
    public static function saveAddAuthGroupRelationship($group_label, $auth_label)
    {
        foreach ($auth_label as $value) {
            $columns = array(
                'group_label' => $group_label,
                'auth_label' => $value
            );
            DB::table(self::TABLE_NAME)->insert($columns);
        }
    }

    /**
     * 删除权限和权限组关系.
     *
     * @param string $group_label 权限组标签.
     *
     * @return boolean
     */
    public static function deleteAuthGroupRelationshipGroupLabel($group_label)
    {
        return DB::table(self::TABLE_NAME)->where('group_label', '=', $group_label)->delete();
    }

    /**
     * 获取权限与权限组关系通过group_label.
     *
     * @param string $group_label 权限组标签.
     *
     * @return array
     */
    public static function getAuthGroupRelationshipByGroupLabel($group_label)
    {
        $authGroupRelationship = DB::table(self::TABLE_NAME)
            ->where('group_label', '=', $group_label)
            ->lists('auth_label');
        return empty($authGroupRelationship) ? array() : $authGroupRelationship;
    }
}
