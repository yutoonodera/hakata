<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    const UPLOAD_DIR = '/uploads/movie/';
    const THUMBNAIL_FILE_PREFIX = 'thumbnail';
    const MOVIE_FILE_PREFIX = 'movie';
    const OPEN_STATUS = 1;
        /**
     * 状態定義
     */
    const STATUS = [

        0 => ['label' => '非公開', 'class' => ''],
        1 => ['label' => '公開', 'class' => 'label-info'],
    ];
    protected $fillable = [
        'thumbnail_file',
        'movie_file',
        'title',
        'start_date',
        'end_date',
        'minutes',
        'product1',
        'price1',
        'product2',
        'price2',
    ];

        /**
     * 状態を表すHTMLクラス
     * @return string
     */
    public function getStatusClassAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }
}
