CREATE OR REPLACE FUNCTION portal.get_geo_osc(idosc INTEGER) RETURNS TABLE (
	geo_lat DOUBLE PRECISION,
	geo_lng DOUBLE PRECISION
) AS $$
BEGIN
	RETURN QUERY
		SELECT
			vw_geo_osc.geo_lat,
			vw_geo_osc.geo_lng
		FROM portal.vw_geo_osc
		WHERE vw_geo_osc.id_osc = idosc;
	RETURN;
END;
$$ LANGUAGE 'plpgsql'
