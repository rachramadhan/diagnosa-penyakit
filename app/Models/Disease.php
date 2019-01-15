<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Disease",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="diagnose",
 *          description="diagnose",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Disease extends Model
{
    use SoftDeletes;

    public $table = 'diseases';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'code',
        'name',
        'description',
        'diagnose'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'diagnose' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * Search disease by random input diagnose
     *
     * @param String $diagnose
     * @param Boolean $singleReturn
     *
     * @return Object
     */
    public function searchDiagnose( $diagnose, $singleReturn = true )
    {
        $words = $this->breakParagraph( $diagnose );
        \Log::info($words);

        $query = "";

        $wordKey = [];

        foreach ($words as $word => $count) {
            if ( $query == "" ) {
                $query = "diagnose like '%" . $word . "%'";
            } else {
                $query .= " or diagnose like '%" . $word . "%'";
            }

            $wordKey[] = $word;
        }

        $diseases = $this->whereRaw( $query );
        \Log::info($diseases->toSql());
        $diseases = $diseases->get();

        $finalResults = $this->calculateResult(
            $diseases
            , $wordKey
        );

        return $this->getPercentage( $finalResults, $singleReturn );
    }

    /**
     * Split paragraph become word
     *
     * @param String $paragraph
     *
     * @return Array
     */
    public function breakParagraph( $paragraph )
    {
        $cleanParagraph = preg_replace('/[^A-Za-z0-9\-.,]/', ' ', $paragraph);

        $splitByDot = explode(".", $cleanParagraph);

        $words = [];

        foreach ($splitByDot as $sentences) {
            $splitBySpaces = explode(" ", $sentences);
            foreach ($splitBySpaces as $splitBySpace) {
                $splitByCommas = explode(",", $splitBySpace);
                foreach ($splitByCommas as $splitByComma) {
                    $splitByStrips = explode("-", $splitByComma);
                    foreach ($splitByStrips as $splitByStrip) {
                        if ( $splitByStrip != "" ) {
                            if ( isset( $words[ strtolower( $splitByStrip ) ] ) ) {
                                $words[ strtolower( $splitByStrip ) ] += 1;
                            } else {
                                $words[ strtolower( $splitByStrip ) ] = 1;
                            }
                        }
                    }
                }
            }
        }

        arsort( $words );

        return $words;
    }

    /**
     * Calculate result of mapping disease and diagnose
     *
     * @param String $diseases
     *
     * @return Array
     */
    public function calculateResult( $diseases, $words )
    {
        $finalResults = [];

        foreach ($diseases as $disease) {
            $diagnoses = $this->breakParagraph( $disease->diagnose );

            foreach ( $diagnoses as $diagnose => $count ) {
                if ( !isset( $finalResults[ $disease->id ] ) ) {
                    $finalResults[ $disease->id ] = [
                        "count" => 0
                        , "total" => 0
                    ];
                }

                $finalResults[ $disease->id ][ "total" ] += $count;

                if ( in_array( $diagnose, $words ) ) {
                    $finalResults[ $disease->id ][ "count" ] += $count;
                }
            }
        }

        return $finalResults;
    }

    /**
     * Calculate percentage of disease
     *
     * @param String $finalResults
     *
     * @return Array
     */
    public function getPercentage( $finalResults, $singleReturn = true )
    {
        $percentages = [];

        if ( $singleReturn ) {
            $percentages = [
                "count" => 0
                , "total" => 0
                , "percentage" => 0
                , "id" => 0
            ];
        }

        foreach ($finalResults as $id => $array) {
            $percentage = ( $array[ "count" ] / $array[ "total" ] ) * 100;
            $percentage = floor($percentage * 100) / 100;

            if ( $singleReturn ) {
                if (
                    (
                        ( $percentages[ "percentage" ] == $percentage )
                        && ( $percentages[ "total" ] <= $array[ "total" ] )
                    )
                    || ( $percentages[ "percentage" ] < $percentage )
                ) {
                    $percentages = $array;
                    $percentages[ "percentage" ] = $percentage;
                    $percentages[ "id" ] = $id;

                }
            } else {
                $percentages[] = [
                    "count" => $array[ "count" ]
                    , "total" => $array[ "total" ]
                    , "percentage" => $percentage
                    , "id" => $id
                    , "disease" => $this->find( $id )
                ];
            }
        }

        if ( $singleReturn ) {
            $percentages[ 'disease' ] = null;

            if ( $percentages[ 'percentage' ] >= 1 ) {
                $percentages[ 'disease' ] = $this->find( $percentages[ "id" ] );

            }
        }

        return $percentages;
    }

}
