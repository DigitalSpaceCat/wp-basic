<?php
/**
 * Plugin Name: 때때로 청소
 * Description: 활성화(activate)만으로 적용, 이어서 비활성(deactivate)
 */

global $wpdb;
//auto-draft
$autodraft_sql = "DELETE FROM $wpdb->posts WHERE post_status = 'auto-draft'";
$wpdb->query($autodraft_sql);

//draft
/*
$draft_sql = "DELETE FROM $wpdb->posts WHERE post_status = 'draft'";
$wpdb->query($draft_sql);
*/

//revision
$revision_sql = "DELETE FROM $wpdb->posts WHERE post_type = 'revision'";
$wpdb->query($revision_sql);
//postmeta
$postmeta_sql = "DELETE pm FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL";
$wpdb->query($postmeta_sql);
//relationships
$relationships_sql = "DELETE FROM $wpdb->term_relationships WHERE term_taxonomy_id=1 AND object_id NOT IN (SELECT id FROM $wpdb->posts)";
$wpdb->query($relationships_sql);
//_edit_lock, _edit_last
$fedit_last_lock_sql = "DELETE FROM $wpdb->postmeta WHERE meta_key = '_edit_lock' OR meta_key = '_edit_last' OR meta_key = '_encloseme'";
$wpdb->query($fedit_last_lock_sql);
// 위젯 옵션
$delete_widget_data_sql = "DELETE FROM $wpdb->options WHERE option_name LIKE 'widget_%' OR option_name = 'sidebars_widgets'";
$wpdb->query($delete_widget_data_sql);
